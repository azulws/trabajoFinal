<?php 
        namespace Models;
        use DateTime;
        class MovieFunction
        {

            private $movieFunctionId;
            private $startDateTime;
            private $room;
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
            
             public function getRoom()
             {
                 return $this->room;
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
            
             public function setRoom($room)
             {
                 $this->room=$room;
             }
            
             public function setMovie($movie)
             {
                 $this->movie=$movie;
             }

             public function getEndDateTime()
             {
                $minutes = $this->getMovie()->getRuntime();
                return date('H:i:s', strtotime('+'.$minutes.'minutes',strtotime($this->getStartDateTime())));
             }

        }