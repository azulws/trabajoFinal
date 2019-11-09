<?php
    namespace Models;

    class Ticket{
        private $id; //numberTicket
        private $qr;
        private $movieFunction;

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
    }