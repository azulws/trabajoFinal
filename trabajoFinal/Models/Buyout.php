<?php
    namespace Models;

    class Buyout{
        private $id; //numberBuyout
        private $discount;
        private $buyDate;
        private $total;
        private $cantTicket;
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
        public function getBuyDate(){
            return $this->buyDate;
        }
        public function setBuyDate($buyDate){
            $this->buyDate=$buyDate;
        }
        public function getTotal(){
            return $this->total;
        }
        public function setTotal($total){
            $this->total=$total;
        }
        public function getCantTicket(){
            return $this->cantTicket;
        }
        public function setCantTicket($cantTicket){
            $this->cantTicket=$cantTicket;
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