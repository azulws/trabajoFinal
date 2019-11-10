<?php
    namespace DAO;
    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use DAO\GenreDBDAO as GenreDBDAO;
    use Models\Genre as Genre;

    class GenresByMoviesDBDAO
    {
         
         private $connection;
         private $genreDBDAO;
         private $tablename = "genresByMovies";

         public function __construct()
         {
            $this->connection = null;
            $this->genreDBDAO = new GenreDBDAO();
         }

    public function writeAll($movie){
        foreach($movie->getGenres() as $genre){
           if($this->read($movie->getId(),$genre->getId())==false)
               $this->Add($movie,$genre);
        }
    }


    public function Add($movie,$genre){

        $sql = "INSERT INTO $this->tablename (genre_id,movie_id) 
        VALUES (:genre_id, :movie_id)";

        $parameters['genre_id'] = $genre->getId();
        $parameters['movie_id'] = $movie->getId();
        
        try
        {
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }
    
    public function read ($movie_id,$genre_id)
    {
        $sql = "SELECT * FROM $this->tablename where genre_id = :genre_id and movie_id = :movie_id";
        $parameters['genre_id'] = $genre_id;
        $parameters['movie_id'] = $movie_id;
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql, $parameters);
            if(!empty($resultSet))
            {
             /*$result = $this->mapear($resultSet);
             $Genre = new Genre();
             $Genre->setId($result[0]->getId());
             $Genre->setDescription($result[0]->getDescription());*/
             return true; //TODO fijarse si se necesita una clase para generobymovies   
        }else
            return false;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
        
    }

    public function readGenresByMovie($movie){
        $sql = "SELECT * FROM $this->tablename where movie_id = :movie_id";
        $parameters['movie_id'] = $movie->getId();
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql, $parameters);
        }
        catch(PDOException $e)
        {
            echo $e;
        }
        if(!empty($resultSet))
        {
            $movie->setGenres($this->mapearGenre($resultSet));  
        }
    }

    protected function mapearGenre($value) {

        $genreList = array();
        foreach($value as $v){
            $Genre = new Genre();
            $Genre = $this->genreDBDAO->read($v['genre_id']);
            array_push($genreList,$Genre);
        }
        if(count($genreList)>0)
            return $genreList;
        else
            return false;
     }
}
      
?>