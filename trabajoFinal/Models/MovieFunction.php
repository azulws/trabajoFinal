<?php
    namespace Models;
    class MovieFunction{
        private $id;
        private $startDatetime;

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id=$id;
        }

        public function getStartDatetime(){
            return $this->startDatetime;
        }
        public function setStartDatetime($startDatetime){
            $this->startDatetime=$startDatetime;
        }
    }
?>