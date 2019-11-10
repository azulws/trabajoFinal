<?php 
    namespace Models;

 class Role {
<<<<<<< HEAD

    private $rol_id;
    private $rolee_description;

    public function __construct()
    {     
    }

=======
    private $role_id;
    private $role_description;
    public function __construct()
    {     
    }
>>>>>>> 7623efa990b7c7fd30e471b8027c96e34e659b87
    public function getRoleId()
    {
        return $this->role_id;
    }
    public function setRoleId($id)
    {
        $this->role_id=$id;
    }
<<<<<<< HEAD

=======
>>>>>>> 7623efa990b7c7fd30e471b8027c96e34e659b87
    public function getRoleDescription()
    {   
        return $this->role_description;
    }
    public function setRoleDescription($mess)
    {
        $this->role_description = $mess;
    }
 }