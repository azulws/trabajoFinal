<?php
    namespace Models;

    class Buyout{
        private $id; //numberBuyout
        private $discount;
        private $date;
        private $total;
        private $ticket;
        private $user;
        private $creditCard;

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id=$id;
        }
        public function getDiscount(){
            return $this->discount;
        }
        public function setDiscount($discount){
            $this->discount=$discount;
        }
        public function getDate(){
            return $this->date;
        }
        public function setDate($date){
            $this->date=$date;
        }
        public function getTotal(){
            return $this->total;
        }
        public function setTotal($total){
            $this->total=$total;
        }
        public function getTicket(){
            return $this->ticket;
        }
        public function setTicket($ticket){
            $this->ticket=$ticket;
        }
        public function getUser(){
            return $this->user;
        }
        public function setUser($user){
            $this->user=$user;
        }
        public function getCreditCard(){
            return $this->creditCard;
        }
        public function setCreditCard($creditCard){
            $this->creditCard=$creditCard;
        }
    }