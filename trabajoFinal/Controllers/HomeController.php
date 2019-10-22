<?php
    namespace Controllers;
    use DAO\PelisDAO as PelisDAO;

    class HomeController
    {
        public function Index($message = "")
        {
            $_SESSION["logged"]=false;
            $pelisList;
            $this->pelisList = new PelisDAO();
            $pageNumber = 1;
            $lista = $this->pelisList->getPeliculas($pageNumber);
            $_SESSION["listaPeliculas"]=$lista;
            include_once(VIEWS_PATH.'home.php');
        }        
    }
?>