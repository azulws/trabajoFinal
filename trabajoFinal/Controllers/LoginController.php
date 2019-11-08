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
            include_once(VIEWS_PATH."home.php");
        }   

/*
    public function log(){
        $register = $this->userDBDAO->read($_POST['user_mail']);
        if($register!=null){
            if($_POST['user_mail']==$register->getEmail() && $_POST['user_password']==$register->getPassword()){
                $_SESSION["logged"]=$register;               
                var_dump($_SESSION['logged']);
                if($register->getRole()=="1")
                { //Rol==1 administrador
                    require_once(VIEWS_PATH."admin.php");// View administrador
                }
                else
                {                
                   
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
*/
    public function log($user_mail='', $password='')
        {
            $role = 0;
            if($user_mail){
                $user = $this->userDBDAO->read($user_mail);   
                if($user!= false && ($user->getPassword() === $password)){
                    $role= $user->getRole();
                    $_SESSION['logged'] = $user;
            }
            switch($role){
                case 1:
                    include_once(VIEWS_PATH."validate-session.php");
                    include_once(VIEWS_PATH."admin.php");
                    break;
                case 2:
                    include_once(VIEWS_PATH."validate-session.php");
                    include_once(VIEWS_PATH."userHome.php");
                    break;
                case 0:
                    $this->index("Usuario y/o Contraseña incorrectos"); 
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

    public function home(){
       
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
        $usuario->setRole($role);

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
        $usuario->setRole(2);    //role tiene que ser 1 o 2 ya que son los unicos valores cargados

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
        include_once(VIEWS_PATH."userList.php");
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
        header("location:../index.php");
    }
    public function showHomeMovieFunctions()
        {
             $movieFunctionDBDAO = new MovieFunctionDBDAO();
             $movieDBDAO = new MovieDBDAO();
             $moviesArray = $movieFunctionDBDAO->readAllMovies();
             $lista = array();
             if($moviesArray!=false)
            {
               foreach($moviesArray as $array=>$v)
               {
                  array_push($lista,$movieDBDAO->read($v['movie_id']));
                   
               }
             }
             
             include_once(VIEWS_PATH."movieList.php");
        }     

    
   
    
}