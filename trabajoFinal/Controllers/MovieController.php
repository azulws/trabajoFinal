<?php 
    namespace Controllers;
    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;

class MovieController{
    private $movieList;
    private $pageNumber;

    public function __construct(){
            $this->movieList = new MovieDAO();
        }

    public function listMovie(){
        $pageNumber = 1;
        $lista = $this->movieList->getMovies($pageNumber);
        include_once(VIEWS_PATH.'movieList.php');
        
    public function nextPage(){
        $pageNumber++;
        $lista = $this->movieList->getMovies($pageNumber);
        include_once(VIEWS_PATH.'movieList.php');
    }
    
}
