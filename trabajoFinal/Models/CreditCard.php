<?php
    namespace Models;

    class CreditCard{
        private $id;
        private $creditCardDescription;
        private $user;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getCreditCardDescription(){
            return $this->creditCardDescription;
        }

        public function setCreditCardDescription($creditCardDescription){
            $this->creditCardDescription=$creditCardDescription;
        }

        public function getUser(){
            return $this->user;
        }

        public function setuserUser($user){
            $this->user=$user;
        }
    }