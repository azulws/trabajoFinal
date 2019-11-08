<?php 
    namespace Models;

 class Role {
    private $role_id;
    private $role_description;
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