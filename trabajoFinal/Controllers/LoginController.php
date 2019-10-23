<?php
namespace Controllers;
use Models\User; 
use DAO\UserDAO as UserDAO;
use DAO\MovieDAO as MovieDAO;

class LoginController{
    private $userDAO;

    public function __construct(){
        $this->userDAO = new UserDAO();
    }

    public function receiveAction(){
        if($_POST["action"]=="Ingresar"){
            $this->log();
        }elseif($_POST["action"]=="Registrar"){
            $this->register();
        }
    }

    public function log(){
        $register = $this->userDAO->traerUser($_POST['user_mail']);
        if($register!=null){
            if($_POST['user_mail']==$register->getEmail() && $_POST['user_password']==$register->getPassword()){
                $_SESSION["logged"]=true;
                $_SESSION["name"]=$register->getName();
                if($register->getRol()=="1"){ //Rol==1 administrador
                    require_once(VIEWS_PATH."admin.php");// View administrador
                }else{
                    $movieList;
                    $this->movieList = new MovieDAO();
                    $pageNumber = 1;
                    $lista = $this->movieList->getMovies($pageNumber);
                    include_once(VIEWS_PATH.'home.php');//View usuario
                }        
            }elseif($_POST["user_password"]!=$register->getPassword()){
                require_once(VIEWS_PATH.'home.php');
            }else{
            require_once(VIEWS_PATH.'home.php');
            }
        }     
    }

    public function register(){
        require_once(VIEWS_PATH."registrarse.php");
    }

    public function homeAdmin(){
        require_once(VIEWS_PATH."admin.php");
    }

    public function home(){
        require_once(VIEWS_PATH."home.php");
    }

    public function createUser($name, $lastname, $email, $password, $dni)
    {
        $usuario = new User();
        $usuario->setEmail($email);
        $usuario->setPassword($password);
        $usuario->setName($name);
        $usuario->setLastname($lastname);
        $usuario->setDni($dni);
        $usuario->setRol(0);

        $this->userDAO->Add($usuario);
        include_once(VIEWS_PATH.'home.php');
    }
}