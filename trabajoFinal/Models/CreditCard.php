<?php
    namespace Models;

    class CreditCard{
        private $id;
        private $number;
        private $description;
        private $user;
        private $securityCode;
        private $expirationDate;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getNumber(){
            return $this->number;
        }

        public function setNumber($number){
            $this->number=$number;
        }

        public function getDescription(){
            return $this->description;
        }

        public function setDescription($description){
            $this->=$description;
        }

        public function getUser(){
            return $this->user;
        }

        public function setuserUser($user){
            $this->user=$user;
        }

        public function getSecurityCode(){
            return $this->securityCode;
        }

        public function setSecurityCode($securityCode){
            $this->securityCode=$securityCode;
        }

        public function getExpirationDate(){
            return $this->expirationDate;
        }

        public function setexpirationDate($expirationDate){
            $this->expirationDate=$expirationDate;
        }
    }