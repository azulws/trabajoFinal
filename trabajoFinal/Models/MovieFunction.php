<?php 
        namespace Models;



        class MovieFunction(){

            private $movieFunctionId;
            private $startDateTime;
            private $cinema; //objtec cinema
            private $movie; // object movie


            public funtion __construct($movieFunctionId,$startDateTime,$cinema,$movie)
             {
              $this->$movieFunctionId=$movieFunctionId;
              $this->$startDateTime=$startDateTime;
              $this->$cinema=$cinema;
              $this->$movie=$movie;
            
             }

             public function getMovieFunctionId()
             {
                 return->$this->$movieFunction;
             }
            
             public function getStartDateTime()
             {
                 return->$this->$startDateTime;
             }
            
             public function getCinema()
             {
                 return->$this->$cinema;
             }
           
             public function getMovie()
             {
                 return->$this->$movie;
             }

             public function setMovieFunction($movieFunctionId)
             {
                 $this->movieFunctionId =$movieFunctionId:
             }
           
             public function setStartDateTime($startDateTime)
             {
                 $this->$startDateTime =$startDateTime:
             }
            
             public function setCinemaId($cinema)
             {
                 $this->$cinema =$cinema:
             }
            
             public function setMovie($movieId)
             {
                 $this->$movieId =$movie:
             }


        }