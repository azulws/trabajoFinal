<?php 
        namespace Models;
        use DateTime;
        class MovieFunction{

            private $movieFunctionId;
            private $startDateTime;
            private $cinema; //object cinema
            private $movie; // object movie
           
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
            
             public function getCinema()
             {
                 return $this->cinema;
             }
           
             public function getMovie()
             {
                 return $this->movie;
             }

             public function setMovieFunctionId($movieFunctionId)
             {
                 $this->movieFunctionId=$movieFunctionId;
             }
           
             public function setStartDateTime($startDateTime)
             {
                 $this->startDateTime=$startDateTime;
             }
            
             public function setCinema(Cinema $cinema)
             {
                 $this->cinema=$cinema;
             }
            
             public function setMovie(Movie $movie)
             {
                 $this->movie=$movie;
             }  
             /* esto agregado ahora
             public function setEndDateTime(Movie $movie){ 
                (int) $minutes = (int) $movie->getRuntime(); //poner en un variable externa 15 minutos
                $this->endDateTime = date('Y-m-d H:i:s', strtotime('+'.$minutes.'minutes',strtotime($this->getStartDateTime()))) ;// capaz que falta :m
                
            }
              public function getEndDateTime(){

                  return $this->endDateTime;
              }
              */
              public function getEndDateTime()
              {
                (int) $minutes = (int) $this->getMovie()->getRuntime(); //poner en un variable externa 15 minutos
                return date('Y-m-d H:i:s', strtotime('+'.$minutes.'minutes',strtotime($this->getStartDateTime()))) ;// capaz que falta :m
               }


        }