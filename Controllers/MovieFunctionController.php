<?php
    namespace Controllers;
    use DAO\MovieFunctionDBDAO as MovieFunctionDBDAO;
    use DAO\MovieDBDAO as MovieDBDAO;
    use DAO\RoomDBDAO as RoomDBDAO;
    use DAO\GenreDBDAO as GenreDBDAO;
    use DAO\CinemaDBDAO as CinemaDBDAO;
    use DAO\TicketDBDAO as TicketDBDAO;
    use Models\Room as Room;
    use Models\Movie as Movie;
    use Models\MovieFunction as MovieFunction;
    use DateTime;

    class MovieFunctionController
    {
        private $movieFunctionDBDAO;
        private $movieDBDAO;
        private $roomDBDAO;
        private $genreDBDAO;
        private $cinemaDBDAO;
        private $ticketDBDAO;

        public function __construct()
        {
            $this->movieFunctionDBDAO = new MovieFunctionDBDAO();
            $this->movieDBDAO = new MovieDBDAO();
            $this->roomDBDAO = new RoomDBDAO();
            $this->genreDBDAO = new GenreDBDAO();
            $this->roomDBDAO = new RoomDBDAO();
            $this->cinemaDBDAO = new CinemaDBDAO();
            $this->ticketDBDAO = new TicketDBDAO();
        }
      
        public function showAddView($cinemaId,$message = ""){
            $rooms = $this->roomDBDAO->readAllByCinema($cinemaId);
            $movies = $this->movieDBDAO->readAll();
            require_once(VIEWS_PATH.'movieFunctionAdd.php');
        }

        public function showAddViewRoom($cinemaId,$message = ""){
            $rooms = $this->roomDBDAO->readAllByCinema($cinemaId);
            $movies = $this->movieDBDAO->isEmpty();
            if($rooms == false){
                //no hay rooms y entra al false
                $this->showSelectCinema("El cine seleccionado no tiene ninguna sala cargada");
            }else if($movies == true){
                $this->showSelectCinema("No hay películas cargadas en base de datos");
            }else{
                $movies = $this->movieDBDAO->readAll();
                $this->showAddView($cinemaId);
            }
        }

        public function showAddViewTime($message = "",$cineId,$movId,$d,$response){
            require_once(VIEWS_PATH.'movieFunctionAddTime.php');
        }

        public function showSelectCinema($message= ""){
            $cinemas = $this->cinemaDBDAO->readAll();
            include_once(VIEWS_PATH."showMovieFunctionCinema.php");
        }

        public function Add($roomId,$movieId,$dateTime)
        {

            $movieFunction = new MovieFunction();
            $movieFunction->setStartDateTime($dateTime);
            $room= new Room();
            $room=$this->roomDBDAO->read($roomId);
            $movieFunction->setRoom($room);
            $movie = new Movie();
            $movie = $this->movieDBDAO->read($movieId);
            $movieFunction->setMovie($movie);            
            $this->movieFunctionDBDAO->Add($movieFunction);
            $this->showMovieFunctionListDB($movieFunction->getRoom()->getCinema()->getId(),"La funcion se agrego correctamente");
        }


        public function showMovieFunctionListDB($cinemaId,$message =''){
            $lista = $this->movieFunctionDBDAO->readAllFunctionsByCinemaId($cinemaId);
            $cineId = $cinemaId;
            include_once(VIEWS_PATH."showFunctionList.php");
        }
            

        public function showMovieFunctionOrderByTimeDB(){
            $lista = $this->movieFunctionDBDAO->readOrderByTime();
            include_once(VIEWS_PATH."showFunctionList.php");
        }

        public function listMovieFunctionListDB(){
            $moviesArray = $this->movieFunctionDBDAO->readAllMovies();
            $genres = $this->genreDBDAO->readAll();
            $lista = array();
            if($moviesArray!=false){
                foreach($moviesArray as $array=>$v){
                array_push($lista,$this->movieDBDAO->read($v['movie_id']));
                }
            }
            include_once(VIEWS_PATH."movieList.php");
        }

        public function listMovieFunctionListByGenreDB($genreId){
            if($genreId == 0){
                $this->listMovieFunctionListDB();
            }else{
                $genre = $this->genreDBDAO->read($genreId);
                $moviesArray = $this->movieFunctionDBDAO->readAllMoviesByGenres($genre);
                $genres = $this->genreDBDAO->readAll();
                $lista = array();
                if($moviesArray!=false){
                    foreach($moviesArray as $array=>$v){
                        array_push($lista,$this->movieDBDAO->read($v['movie_id']));
                    }
                }
                include_once(VIEWS_PATH."movieList.php");
            }
            
        }
        
        public function validateFunctionByDate($roomId,$movieId,$date){
            $response = $this->movieFunctionDBDAO->validateMovieFunctionDateByMovie($movieId,$date);
            $rmId=$roomId;
            $movId=$movieId;
            $d=$date;
            if($response==false){
                $response = $this->movieFunctionDBDAO->validateMovieFunctionDate($roomId,$date);
                $this->showAddViewTime("",$rmId,$movId,$d,$response);
            }else{
                if($roomId == $response[0]->getRoom()->getId()){
                    //aca entro si la peli ya se esta dando ese dia en el cine
                    $response = $this->movieFunctionDBDAO->validateMovieFunctionDate($roomId,$date);
                    $this->showAddViewTime("",$rmId,$movId,$d,$response);
                }else{
                    $room = $this->roomDBDAO->read($rmId);
                    $this->showAddView($room->getCinema()->getId(),"La pelicula está siendo usada este mismo dia. Por favor elija otra");
                }
            }
        }                                                                                          
        
        public function validateFunctionByTime($roomId,$movieId,$date,$time){
            $response = $this->movieFunctionDBDAO->validateMovieFunctionDate($roomId,$date);
            $combinedDT = date('Y-m-d H:i:s', strtotime("$date $time"));
            $newFunction = new MovieFunction();
            $room = $this->roomDBDAO->read($roomId);
            $newFunction->setRoom($room);
            $movie = $this->movieDBDAO->read($movieId);
            $newFunction->setMovie($movie);
            $newFunction->setStartDateTime($combinedDT);
            $notOverlap = false;
            if($response != false){
                foreach($response as $function){
                   
                    $notOverlap = $this->notOverlapFunctions($function,$newFunction);
                    if($notOverlap==false){
                        break;
                    }
                }
                
                if($notOverlap==true){
                    
                    $this->Add($roomId,$movieId,$combinedDT);
                }else{
                    $rmId=$roomId;
                    $movId=$movieId;
                    $d=$date;
                    $this->showAddViewTime($message = "Se superponen las fechas",$rmId,$movId,$d,$response);
                }
            }
            else{
                
                $this->Add($roomId,$movieId,$combinedDT);
            }
        }

        public function notOverlapFunctions($functionA, $functionB){ //true si se solapan, false si no
            //setup
            $startDateA = new DateTime($functionA->getStartDateTime());
            $finishDateA = new DateTime($functionA->getStartDateTime());
            $finishDateA->modify('+'.$functionA->getMovie()->getRuntime().' minute');
            $finishDateA->modify('+15 minute');

            $startDateB = new DateTime($functionB->getStartDateTime());
            $finishDateB = new DateTime($functionB->getStartDateTime());
            $finishDateB->modify('+'.$functionA->getMovie()->getRuntime().' minute');
            $finishDateB->modify('+15 minute');

            //validation
            if($startDateA==$startDateB){
                return false;
            }else{
                if($startDateA>$startDateB && $startDateA>=$finishDateB){
                    return true;
                }else{
                    if($startDateA<$startDateB && $finishDateA<=$startDateB){
                        return true;
                    }
                }
            }
            return false;
        }

        public function RemoveDB($cinemaId, $movieFunctionId)
        {
            $response = $this->ticketDBDAO->readAllByMovieFunction($movieFunctionId);

            if($response!=false){
                $this->showMovieFunctionListDB($cinemaId,"La función no puede ser eliminada porque posee ventas realizadas");
            }else{
                $this->movieFunctionDBDAO->Remove($movieFunctionId);

                $this->showMovieFunctionListDB($cinemaId,"La función fue eliminada con éxito");
            }
            
           
        }

        //chicos la unica manera que consegui de mostrar 
        public function showMovieFunctionsByRoom($room_id)
        {  
            $lista = $this->movieFunctionDBDAO->readOrderByRoomId($room_id); 
            include_once(VIEWS_PATH."showFunctionList.php");
        }
        
        public function showFunctionsByMovie($id)
        {  
            $lista = $this->movieFunctionDBDAO->readAllFunctionsByMovieId($id);
            $movie = $this->movieDBDAO->read($id);
            include_once(VIEWS_PATH."movieFunctionList.php");
        }
    }
    
?> 