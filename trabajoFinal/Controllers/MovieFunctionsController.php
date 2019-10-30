<?php
    namespace Controllers;
    use DAO\MovieFunctionDBDAO as MovieFunction;
    use Models\Cinema as Cinema;
    use Models\Movie as Movie;
    use Models\MovieFunction as MovieFunction;

    class MovieFunctionController()
    {
        private $movieFunctionDBDAO;

        public function __construct(){
            $this->movieFunctionDBDAO = new MovieFunctionDBDAO();
    }
      
    }
       
?> 