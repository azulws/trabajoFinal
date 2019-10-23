<?php
    namespace Models;
    class User{
        private $email;
        private $password;
        private $name;
        private $lastname;
        private $dni;
        private $rol;
        public function __contruct(){
            
        }
        
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
        public function getName(){
            return $this->name;
        }
        public function setName($name){
            $this->name=$name;
        }
        public function getLastname(){
            return $this->lastname;
        }
        public function setLastname($lastname){
            $this->lastname=$lastname;
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