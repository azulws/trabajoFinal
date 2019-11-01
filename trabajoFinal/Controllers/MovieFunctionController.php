<?php
    namespace Controllers;
    use DAO\MovieFunctionDBDAO as MovieFunctionDBDAO;
    use Models\Cinema as Cinema;
    use Models\Movie as Movie;
    use Models\MovieFunction as MovieFunction;

    class MovieFunctionController
    {
        private $movieFunctionDBDAO;

        public function __construct()
        {
            $this->movieFunctionDBDAO = new MovieFunctionDBDAO();
        }
      
        public function showAddView(){
            require_once(VIEWS_PATH.'movieFunctionAdd.php');
        }

        public function Add($date,$cinemaId,$movieId)
        {
            $movieFunction = new MovieFunction();
            $movieFunction->setStartDateTime($date);
            $movieFunction->setCinemaId($cinemaId);
            $movieFunction->setMovieId($movieId);

            $this->movieFunctionDBDAO->Add($movieFunction);

            $this->ShowAddView();
        }

        public function showMovieFunctionListDB(){
            $lista = $this->movieFunctionDBDAO->readAll();
            include_once(VIEWS_PATH."movieFunctionList.php");
        }
    }
       
?> 