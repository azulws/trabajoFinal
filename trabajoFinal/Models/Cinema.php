<?php
    namespace Models;
    class Cinema{
        private $name;
        private $address;
        private $capacity;      
        private $ticketValue;
        private $id;

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

        public function setId($id){
            $this->id=$id;
        }

        public function getId(){
            return $this->id;
        }


    }
