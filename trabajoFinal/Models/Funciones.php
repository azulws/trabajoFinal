<?php
    namespace Models;
    class Genres{
        private $id;
        private $dia;
        private $hora;

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id=$id;
        }
        public function getDescription(){
            return $this->description;
        }
        public function setDescription($description){
            $this->description=$description;
        }
    }
?>