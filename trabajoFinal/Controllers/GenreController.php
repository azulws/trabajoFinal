
<?php 
    namespace Controllers;
    use Models\Genre as Genre;
    use DAO\GenreDBDAO as GenreDBDAO;

    class GenreController{
        private $GenreDBDAO;

        public function genresToDB(){
            $Genres=$this->movieList->getGenres();
            foreach($genres as $genre){
                if($this->genreDBDAO->read($genre->getId())==false){
                    $this->genreDBDAO->Add($genre);
                }
            }
        }
    }