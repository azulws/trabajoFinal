<?php
    namespace Controllers;
    use DAO\MovieFunctionDBDAO as MovieFunctionDBDAO;
    use DAO\MovieDBDAO as MovieDBDAO;

    class HomeController
    {
        public function Index($message = "")
        {
            $_SESSION["logged"]=false;
            $_SESSION["name"]=null;
            $movieFunctionDBDAO = new MovieFunctionDBDAO();
            $movieDBDAO = new MovieDBDAO();
            $moviesArray = $movieFunctionDBDAO->readAllMovies();
            $lista = array();
            if($moviesArray!=false){
                foreach($moviesArray as $array=>$v){
                array_push($lista,$movieDBDAO->read($v['movie_id']));
                }
            }
            include_once(VIEWS_PATH.'home.php');
        }        
    }
?>