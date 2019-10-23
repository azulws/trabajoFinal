<?php
    namespace Models;
    class Cinema{
        private $name;
        private $adress;
        private $capacity;      
        private $ticketValue;
/*
        public function __construct(){

        }

        public function __construct($name,$adress,$capacity,$ticketValue){
            $this->name=$name;
            $this->adress=$adress;
            $this->capacity=$capacity;
            $this->ticketValue=$ticketValue;
        }
*/  
        public function setName($name){
            $this->name=$name;
        }

        public function getName(){
            return $this->name;
        }

        public function setAdress($adress){
            $this->adress=$adress;
        }

        public function getAdress(){
            return $this->adress;
        }

        public function setCapacity($capacity){
            $this->capacity=$capacity;
        }
        
        public function getCapacity(){
            return $this->capacity;
        }
        public function setTicketValue($ticketValue){
            $this->ticketValue=$ticketValue;
        }

        public function getTicketValue(){
            return $this->ticketValue;
        }



    }
