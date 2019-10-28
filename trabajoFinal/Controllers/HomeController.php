<?php
    namespace Controllers;
    use DAO\MovieDBDAO as MovieDBDAO;

    class HomeController
    {
        public function Index($message = "")
        {
            $_SESSION["logged"]=false;
            $_SESSION["name"]=null;
            $movieDBDAO;
            $this->movieDBDAO = new MovieDBDAO();
            $pageNumber = 1;
            $lista = $this->movieDBDAO->readOrderByDate();
            include_once(VIEWS_PATH.'home.php');
        }        
    }
?>