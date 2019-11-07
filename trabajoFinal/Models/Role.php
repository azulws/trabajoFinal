<?php 
    namespace Models;

 class Role {

    private $rol_id;
    private $rolee_description;

    public function __construct()
    {     
    }

    public function getRoleId()
    {
        return $this->role_id;
    }
    public function setRoleId($id)
    {
        $this->role_id=$id;
    }

    public function getRoleDescription()
    {   
        return $this->role_description;
    }
    public function setRoleDescription($mess)
    {
        $this->role_description = $mess;
    }
 }