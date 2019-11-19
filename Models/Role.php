<?php 
    namespace Models;

    class Role {

        private $roleId;
        private $roleDescription;

        public function __construct()
        {     
        }

        public function getId()
        {
            return $this->roleId;
        }
        public function setId($id)
        {
            $this->roleId=$id;
        }
        public function getDescription()
        {   
            return $this->roleDescription;
        }
        public function setDescription($roleDescription)
        {
            $this->roleDescription = $roleDescription;
        }

    }