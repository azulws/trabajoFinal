<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            //require_once(VIEWS_PATH."login.php");
            require_once(VIEWS_PATH."listaPeliculas.php");
        }        
    }
?>