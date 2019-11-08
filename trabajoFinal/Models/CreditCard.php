<?php
    namespace Models;

    class CreditCard{
        private $id;
        private $creditCard;
        private $user;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getCreditCard(){
            return $this->creditCard;
        }

        public function setCreditCard($creditCard){
            $this->creditCard=$creditCard;
        }

        public function getUser(){
            return $this->user;
        }

        public function setuserUser($user){
            $this->user=$user;
        }
    }