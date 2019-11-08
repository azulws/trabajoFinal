<?php 
    namespace Controllers;
    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;
    use DAO\MovieDBDAO as MovieDBDAO;

class MovieController{
    private $movieList;
    private $movieDBDAO;
    private $pageNumber;

    public function __construct(){
            $this->movieList = new MovieDAO();
            $this->movieDBDAO = new MovieDBDAO();
    }
    public function listMovie(){
        $pageNumber = 1;
        $lista = $this->movieList->getMovies($pageNumber);
        include_once(VIEWS_PATH.'movieList.php');
    }
    public function moviesToDB(){
        $pageNumber = 1;
        $movies=$this->movieList->getMovies($pageNumber);
        $this->movieDBDAO->writeAll($movies);
        include_once(VIEWS_PATH.'admin.php');
    }

    public function listMovieAdmin(){
        $pageNumber = 1;
        $lista = $this->movieList->getMovies($pageNumber);
        include_once(VIEWS_PATH.'movieListAdmin.php');
    }
    
}
