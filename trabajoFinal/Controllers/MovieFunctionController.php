<?php
    namespace Controllers;
    use DAO\MovieFunctionDBDAO as MovieFunctionDBDAO;
    use DAO\MovieDBDAO as MovieDBDAO;
    use DAO\CinemaDBDAO as CinemaDBDAO;
    use DAO\GenreDBDAO as GenreDBDAO;
    use Models\Cinema as Cinema;
    use Models\Movie as Movie;
    use Models\MovieFunction as MovieFunction;
    use DateTime;

    class MovieFunctionController
    {
        private $movieFunctionDBDAO;
        private $movieDBDAO;
        private $cinemaDBDAO;
        private $genreDBDAO;

        public function __construct()
        {
            $this->movieFunctionDBDAO = new MovieFunctionDBDAO();
            $this->movieDBDAO = new MovieDBDAO();
            $this->cinemaDBDAO = new CinemaDBDAO();
            $this->genreDBDAO = new GenreDBDAO();
        }
      
        public function showAddView($message = ""){
            $cinemas = $this->cinemaDBDAO->readAll();
            $movies = $this->movieDBDAO->readAll();
            require_once(VIEWS_PATH.'movieFunctionAdd.php');
        }

        public function showAddViewTime($message = "",$cineId,$movId,$d,$response){
            require_once(VIEWS_PATH.'movieFunctionAddTime.php');
        }

        public function Add($cinemaId,$movieId,$dateTime)
        {

            $movieFunction = new MovieFunction();
            $movieFunction->setStartDateTime($dateTime);
            $cinema= new Cinema();
            $cinema=$this->cinemaDBDAO->read($cinemaId);
            $movieFunction->setCinema($cinema);
            $movie = new Movie();
            $movie = $this->movieDBDAO->read($movieId);
            $movieFunction->setMovie($movie);            
            $this->movieFunctionDBDAO->Add($movieFunction);
            $this->ShowAddView();
        }


        public function showMovieFunctionListDB($message =''){
            $lista = $this->movieFunctionDBDAO->readAll();
            if($lista==false) $message = "No hay funciones cargadas en la base de datos";
            include_once(VIEWS_PATH."showFunctionList.php");
        }

        public function showMovieFunctionOrderByTimeDB(){
            $lista = $this->movieFunctionDBDAO->readOrderByTime();
            include_once(VIEWS_PATH."showFunctionList.php");
        }

        public function listMovieFunctionListDB(){
            $moviesArray = $this->movieFunctionDBDAO->readAllMovies();
            $lista = array();
            if($moviesArray!=false){
                foreach($moviesArray as $array=>$v){
                array_push($lista,$this->movieDBDAO->read($v['movie_id']));
                }
            }
            include_once(VIEWS_PATH."movieList.php");
        }

        public function showMovieFunctionByGenreDB(){
            $genres = $this->genreDBDAO->readAll();
            include_once(VIEWS_PATH."selectGenre.php");
        }

        public function listMovieFunctionListByGenreDB($genreId){
            $moviesArray = $this->movieFunctionDBDAO->readAllMoviesByGenres($genreId);
            $lista = array();
            if($moviesArray!=false){
                foreach($moviesArray as $array=>$v){
                    array_push($lista,$this->movieDBDAO->read($v['movie_id']));
                }
            }
            include_once(VIEWS_PATH."movieList.php");
        }
        
        public function validateFunctionByDate($cinemaId,$movieId,$date){
            $response = $this->movieFunctionDBDAO->validateMovieFunctionDateByMovie($movieId,$date);
            $cineId=$cinemaId;
            $movId=$movieId;
            $d=$date;
            if($response==false){
                $response = $this->movieFunctionDBDAO->validateMovieFunctionDate($cinemaId,$date);
                $this->showAddViewTime("",$cineId,$movId,$d,$response);
            }else{
                if($cinemaId == $response[0]->getCinema()->getId()){
                    //aca entro si la peli ya se esta dando ese dia en el cine
                    $response = $this->movieFunctionDBDAO->validateMovieFunctionDate($cinemaId,$date);
                    $this->showAddViewTime("",$cineId,$movId,$d,$response);
                }else{
                    $this->showAddView("La pelicula está siendo usada por otro cine este mismo dia. Por favor elija otro");
                }
            }
        }                                                                                          
        
        public function validateFunctionByTime($cinemaId,$movieId,$date,$time){
            $response = $this->movieFunctionDBDAO->validateMovieFunctionDate($cinemaId,$date);
            $combinedDT = date('Y-m-d H:i:s', strtotime("$date $time"));
            $newFunction = new MovieFunction();
            $cinema = $this->cinemaDBDAO->read($cinemaId);
            $newFunction->setCinema($cinema);
            $movie = $this->movieDBDAO->read($movieId);
            $newFunction->setMovie($movie);
            $newFunction->setStartDateTime($combinedDT);
            $notOverlap = false;
            var_dump($response);
            if($response != false){
                foreach($response as $function){
                   
                    $notOverlap = $this->notOverlapFunctions($function,$newFunction);
                    if($notOverlap==false){
                        break;
                    }
                }
                
                if($notOverlap==true){
                    
                    $this->Add($cinemaId,$movieId,$combinedDT);
                }else{
                    $cineId=$cinemaId;
                    $movId=$movieId;
                    $d=$date;
                    $this->showAddViewTime($message = "Se superponen las fechas",$cineId,$movId,$d,$response);
                }
            }
            else{
                
                $this->Add($cinemaId,$movieId,$combinedDT);
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

        public function RemoveDB($movieFunctionId)
        {
            $this->movieFunctionDBDAO->Remove($movieFunctionId);

            $this->showMovieFunctionListDB();
        }

        //chicos la unica manera que consegui de mostrar 
        public function showMovieFunctionsByCinema($cinema_id)
        {  
             include_once(VIEWS_PATH."validate-session.php");
            $id = (int) $cinema_id;echo "<br>";
            $lista = $this->movieFunctionDBDAO->readOrderByCinemaId($id); 
            include_once(VIEWS_PATH."showFunctionList.php");                                                                           
 
        }

        public function showHomeMovieFunction()
        {
                include_once(VIEWS_PATH."validate-session.php");
                include_once(VIEWS_PATH."navUser.php");
                $this->listMovieFunctionListDB();
        }
        
    }
    
?> 