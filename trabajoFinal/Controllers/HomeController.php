<?php
    namespace Controllers;
    use DAO\MovieDAO as MovieDAO;

    class HomeController
    {
        public function Index($message = "")
        {
            $_SESSION["logged"]=false;
            $_SESSION["name"]=null;
            $movieList;
            $this->movieList = new MovieDAO();
            $pageNumber = 1;
            $lista = $this->movieList->getMovies($pageNumber);
            $_SESSION["movieList"]=$lista;
            include_once(VIEWS_PATH.'home.php');
        }        
    }
?>