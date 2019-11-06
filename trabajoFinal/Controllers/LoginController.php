<?php
namespace Controllers;
use Models\User; 
use DAO\UserDAO as UserDAO;
use DAO\UserDBDAO as UserDBDAO;
use DAO\MovieDAO as MovieDAO;
use DAO\MovieFunctionDBDAO as MovieFunctionDBDAO;
use DAO\MovieDBDAO as MovieDBDAO;

class LoginController{
    private $userDAO;
    private $userDBDAO;

    public function __construct(){
        $this->userDAO = new UserDAO();
        $this->userDBDAO = new UserDBDAO();
    }

    public function receiveAction(){
        if($_POST["action"]=="Ingresar"){
            $this->log();
        }elseif($_POST["action"]=="Registrar"){
            $this->register();
        }
    }

    public function log(){
        $register = $this->userDBDAO->read($_POST['user_mail']);
        if($register!=null){
            if($_POST['user_mail']==$register->getEmail() && $_POST['user_password']==$register->getPassword()){
                $_SESSION["logged"]=$register;               
                var_dump($_SESSION['user_id']=$register->getId());
                if($register->getRole()=="1"){ //Rol==1 administrador
                    require_once(VIEWS_PATH."admin.php");// View administrador
                }else{
                
                    $movieFunctionDBDAO = new MovieFunctionDBDAO();
                    $movieDBDAO = new MovieDBDAO();
                    $moviesArray = $movieFunctionDBDAO->readAllMovies();
                    $lista = array();
                    if($moviesArray!=false){
                        foreach($moviesArray as $array=>$v){
                        array_push($lista,$movieDBDAO->read($v['movie_id']));
                    }
                }
                
                include_once(VIEWS_PATH.'home.php');
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
        include_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."admin.php");
    }

    public function home(){
        include_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."home.php");
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
        $usuario->setRol($role);

        $this->userDAO->Add($usuario);
        include_once(VIEWS_PATH.'home.php');
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
        $usuario->setRol(2);    //role tiene que ser 1 o 2 ya que son los unicos valores cargados

        $this->userDBDAO->Add($usuario);

        include_once(VIEWS_PATH.'home.php');
    }

    public function showUserList(){
        include_once(VIEWS_PATH."validate-session.php");
        $lista = $this->userDAO->GetAll();
        include_once(VIEWS_PATH."userlist.php");
    }

    public function showUserListDB(){
        include_once(VIEWS_PATH."validate-session.php");
        $lista = $this->userDBDAO->readAll();
        include_once(VIEWS_PATH."userlist.php");
    }

    public function Remove($id) //TODO cambiar a $user
    {   
        include_once(VIEWS_PATH."validate-session.php");
        $this->userDAO->Remove($id);
        $this->showUserList();
    }

    public function RemoveDB($id)
    {   
        include_once(VIEWS_PATH."validate-session.php");
        $this->userDBDAO->Remove($id);
        $this->showUserListDB();
    }

    public function UpdateRoleDB($id) //TODO corregir problema
    {
        include_once(VIEWS_PATH."validate-session.php");
        $this->userDBDAO->UpdateRole($id);
        $this->showUserListDB();
    }
    public function logout()
    {   
        session_destroy();
        echo "estoy aca";
        header("location:../index.php");
    }
    
}