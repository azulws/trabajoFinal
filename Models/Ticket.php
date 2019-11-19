<?php
    namespace Models;

    class Ticket{
        private $id;
        private $qr;
        private $movieFunction;
        private $buyout;

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id=$id;
        }
        
        public function getQr(){
            return $this->qr;
        }
        public function setQr($qr){
            $this->qr=$qr;
        }

        public function getMovieFunction(){
            return $this->movieFunction;
        }
        public function setMovieFunction($movieFunction){
            $this->movieFunction=$movieFunction;
        }

        public function getBuyout(){
            return $this->buyout;
        }
        public function setBuyout($buyout){
            $this->buyout=$buyout;
        }
    }