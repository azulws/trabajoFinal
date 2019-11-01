<?php 
    namespace Controllers;
    use Models\Genre as Genre;
    use DAO\GenreDAO as GenreDAO;
    use DAO\GenreDBDAO as GenreDBDAO;

    class GenreController{
        private $genreDAO;
        private $genreDBDAO;

        public function __construct(){
            $this->genreDAO = new GenreDAO();
            $this->genreDBDAO = new GenreDBDAO();
        }

        public function genresToDB(){
            $genres=$this->genreDAO->getGenres();
            $this->genreDBDAO->writeAll($genres);
            include_once(VIEWS_PATH.'admin.php');
        }
    }