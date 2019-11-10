<?php 
        namespace Models;
        use DateTime;
        class MovieFunction
        {

            private $movieFunctionId;
            private $startDateTime;
            private $cinema;
            private $movie;

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
            
             public function setMovie($movie)
             {
                 $this->movie=$movie;
             }

             public function getEndDateTime()
             {
                $minutes = $this->getMovie()->getRuntime();
                return date('Y-m-d H:i:s', strtotime('+'.$minutes.'minutes',strtotime($this->getStartDateTime())));
             }

        }