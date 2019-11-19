<?php
namespace Controllers;
use Models\User; 
use Models\Role;
use DAO\UserDAO as UserDAO;
use DAO\UserDBDAO as UserDBDAO;
use DAO\MovieDAO as MovieDAO;
use DAO\MovieFunctionDBDAO as MovieFunctionDBDAO;
use DAO\CreditCardDBDAO as CreditCardDBDAO;
use Controllers\MovieFunctionController as MovieFunctionController;
use DAO\MovieDBDAO as MovieDBDAO;
use DAO\GenreDBDAO as GenreDBDAO;

class LoginController{
    private $userDAO;
    private $userDBDAO;
    private $MovieFunctionController;
    private $creditCardDBDAO;
    private $genreDBDAO;


    public function __construct(){
        $this->userDAO = new UserDAO();
        $this->userDBDAO = new UserDBDAO();
        $this->movieFunctionController = new MovieFunctionController();
        $this->creditCardDBDAO = new CreditCardDBDAO();
        $this->genreDBDAO = new GenreDBDAO();

    } 

        public function Index($message = "")
        {
            $movieFunctionDBDAO = new MovieFunctionDBDAO();
            $movieDBDAO = new MovieDBDAO();
            $moviesArray = $movieFunctionDBDAO->readAllMovies();
            $genres = $this->genreDBDAO->readAll();
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
            $role = 0;
            if($user_mail){
                $user = $this->userDBDAO->read($user_mail);   
                if($user!= false && ($user->getPassword() === $password)){
                    $role= $user->getRole()->getId();
                    $_SESSION['logged'] = $user;
            }
            switch($role){
                case 1:
                    include_once(VIEWS_PATH."validate-session.php");
                    $this->Index();
                    break;
                case 2:
                    include_once(VIEWS_PATH."validate-session.php");
                    $this->Index();
                    break;
                case 0:
                    $this->index("Usuario y/o Contraseña incorrectos"); 
                    break;
            }
        }
    }

    public function register(){
        require_once(VIEWS_PATH."registrarse.php");
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
        $role = new Role();
        $role->setId(2);
        $role->setDescription("user");
        $usuario->setRole($role);

        $this->userDAO->Add($usuario);
        $this->Index("El usuario se creó con éxito");
    }

    public function createUserDB($name, $lastname, $email, $password, $dni)
    {   
        if(!$this->userDBDAO->userExists($email)){
            $usuario = new User();
            $usuario->setEmail($email);
            $usuario->setPassword($password);
            $usuario->setName($name);
            $usuario->setLastname($lastname);
            $usuario->setDni($dni);
            $role = new Role();
            $role->setId(2);
            $role->setDescription("user");
            $usuario->setRole($role);
            $this->userDBDAO->Add($usuario);

            $this->Index("El usuario $email se registro con exito");
        }else{
            $this->Index("El usuario $email ya está siendo utilizado");
        }
        
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
        $u=$this->userDBDAO->read($email);
        $response = $this->creditCardDBDAO->readAllByUser($u);
        if($response!=false){
            $this->showUserListDB("El usuario no puede ser eliminados ya que tiene datos guardados");
        }else{
            $this->userDBDAO->Remove($u->getEmail());
            $this->showUserListDB("El usuario se elimino correctamente");
        }
        
    }

    public function UpdateRoleDB($email) //TODO corregir problema
    {
        $this->userDBDAO->UpdateRole($email);
        $this->showUserListDB("El rol del usuario $email fue actualizado con exito");
    }

    public function logout()
    {   
        session_destroy();
        header("location:../index.php");
    }

}