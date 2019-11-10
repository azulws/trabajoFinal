<?php 
    namespace Controllers;
    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;
    use DAO\MovieDBDAO as MovieDBDAO;

class MovieController
{
    private $movieList;
    private $movieDBDAO;
    private $pageNumber;

    public function __construct(){
            $this->movieList = new MovieDAO();
            $this->movieDBDAO = new MovieDBDAO();
    }
    public function listMovie(){
        include_once(VIEWS_PATH."validate-session.php");
        $pageNumber = 1;
        $lista = $this->movieList->getMovies($pageNumber);
        include_once(VIEWS_PATH.'movieList.php');
    }
    public function moviesToDB(){
        include_once(VIEWS_PATH."validate-session.php");
        $pageNumber = 1;
        $movies=$this->movieList->getMovies($pageNumber);
        $this->movieDBDAO->writeAll($movies);
        include_once(VIEWS_PATH.'admin.php');
    }

    public function listMovieAdmin($message = ""){
        include_once(VIEWS_PATH."validate-session.php");
        $lista = $this->movieDBDAO->readAll();
        if($lista==false){
            $message = "No hay películas cargadas en la base de datos. Por favor, agregar desde la API";
        }
        include_once(VIEWS_PATH.'movieListAdmin.php');
    }

    public function listMovieApi($message = ""){
        if(isset($_SESSION['pageNumber'])){
            $lista = $this->movieList->getMoviesByPage($_SESSION['pageNumber']);
        }else{
            $_SESSION['pageNumber'] = 1;
            $lista = $this->movieList->getMoviesByPage($_SESSION['pageNumber']);
        }
        include_once(VIEWS_PATH.'movieListApi.php');
    }

    public function nextPage(){
        $_SESSION['pageNumber'] = $_SESSION['pageNumber']+1; 
        $this->listMovieApi(); 
    }

    public function prevPage(){
        if($_SESSION['pageNumber']>1){
            $_SESSION['pageNumber'] = $_SESSION['pageNumber']-1; 
        }
        $this->listMovieApi(); 
    }

    public function add($id){
        if(!($this->movieExistsDB($id))){
            $movie = new Movie();
            $movie = $this->movieList->getMovieById($id);
            $this->movieDBDAO->Add($movie);
            $this->listMovieApi("La película se agrego a la base de datos!");
        }else{
            $this->listMovieApi("La película ya está cargada en la base de datos");
        }
    }

    public function movieExistsDB($id){
        if($this->movieDBDAO->read($id) == false){
            return false;  
        }
        return true;
    }
    
}
