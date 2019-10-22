<?php
namespace Controllers;
use Models\Usuario; 
use DAO\UserDAO as UserDAO;
use DAO\PelisDAO as PelisDAO;

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
        $registro = $this->userDAO->traerUsuario($_POST['user_mail']);
        if($registro!=null){
            if($_POST['user_mail']==$registro->getEmail() && $_POST['user_password']==$registro->getPassword()){
                if($registro->getRol()=="1"){ //Rol==1 administrador
                    require_once(VIEWS_PATH."admin.php");// View administrador
                }else{
                    $pelisList;
                    $this->pelisList = new PelisDAO();
                    $pageNumber = 1;
                    $lista = $this->pelisList->getPeliculas($pageNumber);
                    include_once(VIEWS_PATH.'listaPeliculas.php');//View usuario
                }        
            }elseif($_POST["user_password"]!=$registro->getPassword()){
                require_once(VIEWS_PATH.'login.php');
            }else{
            require_once(VIEWS_PATH.'login.php');
            }
        }     
    }

    public function register(){
        require_once(VIEWS_PATH."registrarse.php");
    }

    public function homeAdmin(){
        require_once(VIEWS_PATH."admin.php");
    }
}