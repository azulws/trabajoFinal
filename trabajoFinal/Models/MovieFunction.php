<?php 
        namespace Models;
        class MovieFunction{

            private $movieFunctionId;
            private $startDateTime;
            private $cinemaId; //object cinema
            private $movieId; // object movie


            public function __construct()
             {
            
             }

             public function getMovieFunctionId()
             {
                return $this->movieFunctionId;
             }
            
             public function getStartDateTime()
             {
                 return $this->startDateTime;
             }
            
             public function getCinemaId()
             {
                 return $this->cinemaId;
             }
           
             public function getMovieId()
             {
                 return $this->movieId;
             }

             public function setMovieFunctionId($movieFunctionId)
             {
                 $this->movieFunctionId =$movieFunctionId;
             }
           
             public function setStartDateTime($startDateTime)
             {
                 $this->startDateTime =$startDateTime;
             }
            
             public function setCinemaId($cinemaId)
             {
                 $this->cinemaId =$cinemaId;
             }
            
             public function setMovieId($movieId)
             {
                 $this->movieId =$movieId;
             }


        }