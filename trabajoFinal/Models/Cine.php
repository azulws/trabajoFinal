<?php
    namespace Models;
    class Cine{
        private $nombre;
        private $direccion;
        private $capacidad;      
        private $valorEntrada;
/*
        public function __construct(){

        }

        public function __construct($nombre,$direccion,$capacidad,$valorEntrada){
            $this->nombre=$nombre;
            $this->direccion=$direccion;
            $this->capacidad=$capacidad;
            $this->valorEntrada=$valorEntrada;
        }
*/  
        public function setNombre($nombre){
            $this->nombre=$nombre;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function setDireccion($direccion){
            $this->direccion=$direccion;
        }

        public function getDireccion(){
            return $this->direccion;
        }

        public function setCapacidad($capacidad){
            $this->capacidad=$capacidad;
        }
        
        public function getCapacidad(){
            return $this->capacidad;
        }
        public function setValorEntrada($valorEntrada){
            $this->valorEntrada=$valorEntrada;
        }

        public function getValorEntrada(){
            return $this->valorEntrada;
        }



    }
