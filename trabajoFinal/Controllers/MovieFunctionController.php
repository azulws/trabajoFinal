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
      
        public function showAddView(){
            include_once(VIEWS_PATH."validate-session.php");
            $cinemas = $this->cinemaDBDAO->readAll();
            $movies = $this->movieDBDAO->readAll();
            require_once(VIEWS_PATH.'movieFunctionAdd.php');
        }

        public function Add($cinemaId,$movieId,$dateTime)
        { 
            include_once(VIEWS_PATH."validate-session.php");
            $movieFunction = new MovieFunction();
            $movieFunction->setStartDateTime($dateTime);
            $movieFunction->setCinemaId($cinemaId);
            $movieFunction->setMovieId($movieId);
            $movie= new Movie();
            $movie = $this->movieDBDAO->read($movieId);
            $movieFunction->setEndDateTime($movie);
            $this->movieFunctionDBDAO->Add($movieFunction);

            $this->ShowAddView();
        }

        public function showMovieFunctionListDB(){
            include_once(VIEWS_PATH."validate-session.php");
            $lista = $this->movieFunctionDBDAO->readAll();
            include_once(VIEWS_PATH."showFunctionList.php");
        }

        public function showMovieFunctionOrderByTimeDB(){
            include_once(VIEWS_PATH."validate-session.php");
            $lista = $this->movieFunctionDBDAO->readOrderByTime();
            include_once(VIEWS_PATH."showFunctionList.php");
        }

        public function listMovieFunctionListDB(){
            include_once(VIEWS_PATH."validate-session.php");
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
            include_once(VIEWS_PATH."validate-session.php");
            $genres = $this->genreDBDAO->readAll();
            include_once(VIEWS_PATH."selectGenre.php");
        }

        public function listMovieFunctionListByGenreDB($genreId){
            include_once(VIEWS_PATH."validate-session.php");
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
            include_once(VIEWS_PATH."validate-session.php");
            $response = $this->movieFunctionDBDAO->validateMovieFunctionDateByMovie($movieId,$date);
            $cineId=$cinemaId;
            $movId=$movieId;
            $d=$date;
            if($response==false){
                $response = $this->movieFunctionDBDAO->validateMovieFunctionDate($cinemaId,$date);
                include_once(VIEWS_PATH."movieFunctionAddTime.php");
            }else{
                if($cinemaId == $response[0]->getCinemaId()){
                    //aca entro si la peli ya se esta dando ese dia en el cine
                    $response = $this->movieFunctionDBDAO->validateMovieFunctionDate($cinemaId,$date);
                    include_once(VIEWS_PATH."movieFunctionAddTime.php");
                }else{
                    echo "La pelicula esta siendo usada por otro cine, kb";
                }
            }
        }                                                                                          
        
        public function validateFunctionByTime($cinemaId,$movieId,$date,$time){
            include_once(VIEWS_PATH."validate-session.php");
            $response = $this->movieFunctionDBDAO->validateMovieFunctionDate($cinemaId,$date);
            $combinedDT = date('Y-m-d H:i:s', strtotime("$date $time"));
            $newFunction = new MovieFunction();
            $newFunction->setCinemaId($cinemaId);
            $newFunction->setMovieId($movieId);
            $newFunction->setStartDateTime($combinedDT);

            $notOverlap = false;
            if($response != false){
                foreach($response as $function){
                    $notOverlap = $this->notOverlapFunctions($function,$newFunction);
                    if($notOverlap==false){
                        break;
                    }
                }
                var_dump($notOverlap);
                if($notOverlap==true){
                    $this->Add($cinemaId,$movieId,$combinedDT);
                }else{
                    echo 'Se superponen las fechas';
                    $cineId=$cinemaId;
                    $movId=$movieId;
                    $d=$date;
                    include_once(VIEWS_PATH.'movieFunctionAddTime.php');
                }
            }
            else{
                $this->Add($cinemaId,$movieId,$combinedDT);
            }
        }

        public function notOverlapFunctions($functionA, $functionB){ //true si se solapan, false si no
            //setup
            include_once(VIEWS_PATH."validate-session.php");
            $startDateA = new DateTime($functionA->getStartDateTime());
            $movieA = $this->movieDBDAO->read($functionA->getMovieId());
            $finishDateA = new DateTime($functionA->getStartDateTime());
            $finishDateA->modify('+'.$movieA->getRuntime().' minute');
            $finishDateA->modify('+15 minute');

            $startDateB = new DateTime($functionB->getStartDateTime());
            $movieB = $this->movieDBDAO->read($functionB->getMovieId());
            $finishDateB = new DateTime($functionB->getStartDateTime());
            $finishDateB->modify('+'.$movieB->getRuntime().' minute');
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

        public function RemoveDB($movieFunctionId) //TODO cambiar a $cinema
        {
            include_once(VIEWS_PATH."validate-session.php");
            $this->movieFunctionDBDAO->Remove($movieFunctionId);

            $this->showMovieFunctionListDB();
        }

        //chicos la unica manera que consegui de mostrar 
        public function showMovieFunctionsByCinema($cinema_id)
        {   include_once(VIEWS_PATH."validate-session.php");
            $id = (int) $cinema_id;
            $lista = $this->movieFunctionDBDAO->readOrderByCinemaId($id);
            $cinema = $this->cinemaDBDAO->read($id);
            if($lista==false)
            {
            	echo '<script>alert("No hay funciones en la base de datos");</script>';
            }else
                {
                    foreach($lista as $item)
                    {   
                        //$movie = $this->movieDBDAO->read($item->getMovieId());
                        //$item->setEndDateTime($movie);
                        //include_once(VIEWS_PATH."showFunctionListByCinema.php");
                        include_once(VIEWS_PATH."showFunctionList.php");
                    }
                }
            }                                                                                                                        
 }
    
?> 