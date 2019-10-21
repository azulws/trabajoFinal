<?php
    namespace Models;
    class Usuario{
        private $email;
        private $password;
        private $nombre;
        private $apellido;
        private $dni;
        private $rol;
        public function __contruct(){
            
        }
/*
        public function __construct($email,$password,$nombre,$apellido,$dni){
            $this->email=$email;
            $this->password=$password;
            $this->nombre=$nombre;
            $this->apellido=$apellido;
            $this->dni=$dni;
        }
*/
        public function getEmail(){
            return $this->email;
        }
        public function setEmail($email){
            $this->email=$email;
        }
        public function getPassword(){
            return $this->password;
        }
        public function setPassword($password){
            $this->password=$password;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre=$nombre;
        }
        public function getApellido(){
            return $this->apellido;
        }
        public function setApellido($apellido){
            $this->apellido=$apellido;
        }
        public function getDni(){
            return $this->dni;
        }
        public function setDni($dni){
            $this->dni=$dni;
        }
        public function getRol(){
            return $this->rol;
        }
        public function setRol($rol){
            $this->rol=$rol;
        }

    }
    ?>