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
            /*foreach($genres as $genre){
                if($this->genreDBDAO->read($genre->getId())==false){
                    $this->genreDBDAO->Add($genre);
                }
            }*/
            $this->genreDBDAO->writeAll($genres);
        }
    }