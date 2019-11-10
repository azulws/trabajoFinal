<?php
namespace Controllers;
use Models\User; 
use DAO\UserDAO as UserDAO;
use DAO\UserDBDAO as UserDBDAO;
use DAO\MovieDAO as MovieDAO;
use DAO\MovieFunctionDBDAO as MovieFunctionDBDAO;
use Controllers\MovieFunctionController as MovieFunctionController;
use DAO\MovieDBDAO as MovieDBDAO;

class LoginController{
    private $userDAO;
    private $userDBDAO;
    private $MovieFunctionController;

    public function __construct(){
        $this->userDAO = new UserDAO();
        $this->userDBDAO = new UserDBDAO();
        $this->movieFunctionController = new MovieFunctionController();
    } 

        public function Index($message = "")
        {
            
            $movieFunctionDBDAO = new MovieFunctionDBDAO();
            $movieDBDAO = new MovieDBDAO();
            $moviesArray = $movieFunctionDBDAO->readAllMovies();
            $lista = array();
            if($moviesArray!=false){
                foreach($moviesArray as $array=>$v){
                array_push($lista,$movieDBDAO->read($v['movie_id']));
                }
            }
            
            include_once(VIEWS_PATH.'login.php');
        }

    

    public function log($user_mail='', $password='')
        {
            $role=0;
            if($user_mail){
                $user = $this->userDBDAO->read($user_mail);   
                if($user!= false && ($user->getPassword() === $password)){
                    $role= $user->getRole();
                    $_SESSION['logged'] = $user;
            }
            switch($role){
                case 1:
                    include_once(VIEWS_PATH."validate-session.php");
                    include_once(VIEWS_PATH."navAdmin.php");
                    break;
                case 2:
                    include_once(VIEWS_PATH."validate-session.php");
                    include_once(VIEWS_PATH."userHome.php");
                    break;
                case 0:
                    $message="Usuario y/o Contraseñia incorrectos";
                    $this->Index($message);
                    break;
            }
        }
    }


/*
    public function log($user_mail='', $password='')
        {   
            if($user_mail){
                $user = $this->userDBDAO->read($user_mail);   
                $role= $user->getRole();
            }else{
                $role=0;
            }             
                switch($role){
                 case 1:
                       if(($user != null) && ($user->getPassword() === $password)){
                       $_SESSION["logged"] = $user;
                       include_once(VIEWS_PATH."validate-session.php");
                       include_once(VIEWS_PATH."admin.php");
                       //$this->ShowAddView();
                        }else
                            $rol=5;            
                       break;
                 case 2: 
                       if(($user != null) && ($user->getPassword() === $password)){
                       $_SESSION["logged"] = $user;
                       include_once(VIEWS_PATH."validate-session.php");
                       include_once(VIEWS_PATH."header.php");
                       include_once(VIEWS_PATH."userHome.php");
                        }else 
                         $rol=5;
                      break;
                case 3: 
                        if(($user != null) && ($user->getPassword() === $password)){
                        $_SESSION["logged"] = $user;
                        include_once(VIEWS_PATH."validate-session.php");
                        //puedo ser super admin
                        include_once(VIEWS_PATH."header.php");
                        include_once(VIEWS_PATH."admin.php");
                        }else 
                        $rol=5;
                        break;
                case 4: 
                        //borrado logico o inahbilito a este usuario.
                         $this->index("usuario inhabilitado o eliminado");
                        break;
                case 5:
                        $this->index("Usuario y/o Contraseña incorrectos"); 
                        //header("location:../index.php");                            
                        break;
                case 0:
                        //$this->index("Anonimo"); 
                        header("location:../index.php");
                        break;          

            }
        }
*/
    public function register(){
        require_once(VIEWS_PATH."registrarse.php");
    }

    public function homeAdmin(){
        include_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."admin.php");
    }

    public function createUser($name, $lastname, $email, $password, $dni, $role)
    {   
        include_once(VIEWS_PATH."validate-session.php");
        $usuario = new User();
        $usuario->setEmail($email);
        $usuario->setPassword($password);
        $usuario->setName($name);
        $usuario->setLastname($lastname);
        $usuario->setDni($dni);
        $usuario->setRole($role);

        $this->userDAO->Add($usuario);
        $this->Index("El usuario se creó con éxito");
    }

    public function createUserDB($name, $lastname, $email, $password, $dni)
    {   
        include_once(VIEWS_PATH."validate-session.php");
        $usuario = new User();
        $usuario->setEmail($email);
        $usuario->setPassword($password);
        $usuario->setName($name);
        $usuario->setLastname($lastname);
        $usuario->setDni($dni);
        $usuario->setRole(2);    //role tiene que ser 1 o 2 ya que son los unicos valores cargados

        $this->userDBDAO->Add($usuario);

        $this->Index();
    }

    public function showUserList()
    {
        include_once(VIEWS_PATH."validate-session.php");
        $lista = $this->userDAO->GetAll();
        include_once(VIEWS_PATH."userList.php");
    }

    public function showUserListDB($message="")
    {
        include_once(VIEWS_PATH."validate-session.php");
        $lista = $this->userDBDAO->readAll();
        if($lista==false){
            $message = "No hay usuarios cargados en la base de datos";
        }
        include_once(VIEWS_PATH."userList.php");
    }

    public function Remove($email) //TODO cambiar a $user
    {
        $this->userDAO->Remove($email);
        $this->showUserList();
    }

    public function RemoveDB($email)
    {
        $this->userDBDAO->Remove($email);
        $this->showUserListDB();
    }

    public function UpdateRoleDB($id) //TODO corregir problema
    {
        $this->userDBDAO->UpdateRole($email);
        $this->showUserListDB();
    }

    public function logout()
    {   
        session_destroy();
        header("location:../index.php");
    }


    
}