<?php
    namespace Controllers;
    use DAO\PelisDAO as PelisDAO;

    class HomeController
    {
        public function Index($message = "")
        {
            $pelisList;
            $this->pelisList = new PelisDAO();
            $pageNumber = 1;
            $lista = $this->pelisList->getPeliculas($pageNumber);
            include_once(VIEWS_PATH.'home.php');
        }        
    }
?>