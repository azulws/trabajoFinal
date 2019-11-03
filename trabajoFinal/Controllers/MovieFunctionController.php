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
            $cinemas = $this->cinemaDBDAO->readAll();
            $movies = $this->movieDBDAO->readAll();
            require_once(VIEWS_PATH.'movieFunctionAdd.php');
        }

        public function Add($cinemaId,$movieId,$dateTime)
        {
            $movieFunction = new MovieFunction();
            $movieFunction->setStartDateTime($dateTime);
            $movieFunction->setCinemaId($cinemaId);
            $movieFunction->setMovieId($movieId);

            $this->movieFunctionDBDAO->Add($movieFunction);

            $this->ShowAddView();
        }

        public function showMovieFunctionListDB(){
            $lista = $this->movieFunctionDBDAO->readAll();
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
            $response = $this->movieFunctionDBDAO->validateMovieFunctionDate($movieId,$date);
            var_dump($cinemaId);
            var_dump($movieId);
            var_dump($date);
            $cineId=$cinemaId;
            $movId=$movieId;
            $d=$date;
            if($response==false){
                include_once(VIEWS_PATH."movieFunctionAddTime.php");
            }else{
                if($cinemaId == $response[0]->getCinemaId()){
                    //aca entro si la peli ya se esta dando ese dia en el cine
                    include_once(VIEWS_PATH."movieFunctionAddTime.php");
                }else{
                    echo "La pelicula esta siendo usada por otro cine, kb";
                }
            }
        }                                                                                          
        
        public function validateFunctionByTime($cinemaId,$movieId,$date,$time){
            $response = $this->movieFunctionDBDAO->validateMovieFunctionDate($movieId,$date);
            $combinedDT = date('Y-m-d H:i:s', strtotime("$date $time"));
            $newFunction = new MovieFunction();
            $newFunction->setCinemaId($cinemaId);
            $newFunction->setMovieFunctionId($movieId);
            $newFunction->setStartDateTime($combinedDT);

            $overlap = false;
            if($response != false){
                foreach($response as $function){
                    $overlap = $this->overlapFunctions($function,$newFunction);
                }
    
                if($overlap==false){
                    $this->Add($cinemaId,$movieId,$combinedDT);
                }else{
                    echo 'Se superponen las fechas';
                    include_once(VIEWS_PATH.'movieFunctionAdd.php');
                }
            }
            else{
                echo "holaaa soy 118";
                var_dump($response);
            }
        }

        public function overlapFunctions($functionA, $functionB){ //true si se solapan, false si no
            //setup
            var_dump($functionB);
            $startDateA = new DateTime($functionA->getStartDateTime());
            $movieA = $this->movieDBDAO->read($functionA->getMovieId());
            $finishDateA = $startDateA;
            $finishDateA->modify('+'.$movieA->getRuntime().' minute');
            $finishDateA->modify('+15 minute');

            $startDateB = new DateTime($functionB->getStartDateTime());
            $movieB = $this->movieDBDAO->read($functionB->getMovieId());
            var_dump($movieB);
            $finishDateB = $startDateB;
            $finishDateB->modify('+'.$movieB->getRuntime().' minute');
            $finishDateB->modify('+15 minute');
            
            //validation
            if($startDateA==$startDateB)
            return true;
                else{
                    if($startDateA<$startDateB && $finishDateA > $startDateB){
                        return true;
                }else{
                    if($finishDateB > $startDateA && $startDateA>$startDateB){
                        return true;
                    }    
                }
            }
            return false;
        }
                                                                                                                               
 }
    
?> 