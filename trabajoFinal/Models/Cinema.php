<?php
    namespace Models;
    class Cinema{
        private $name;
        private $address;
        private $capacity;      
        private $ticketValue;
/*
        public function __construct(){

        }

        public function __construct($name,$address,$capacity,$ticketValue){
            $this->name=$name;
            $this->address=$address;
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

        public function setAddress($address){
            $this->address=$address;
        }

        public function getAddress(){
            return $this->address;
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
