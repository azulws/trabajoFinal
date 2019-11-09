<?php
    namespace DAO;
    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\Genre as Genre;

    class GenresByMoviesDBDAO
    {
         
         private $connection;

         public function __construct()
         {
            $this->connection = null;
         }

    public function writeAll($movie){
        foreach($movie->getGenres() as $genreId){
           if($this->read($movie->getMovieId(),$genreId)==false)
               $this->Add($movie,$genreId);
        }
    }


    public function Add($movie,$genre){

        $sql = "INSERT INTO genresByMovies (genre_id,movie_id) 
        VALUES (:genre_id, :movie_id)";

        $parameters['genre_id'] = $genre->getId();
        $parameters['movie_id'] = $movie->getMovieId();
        
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
        $sql = "SELECT * FROM genresByMovies where genre_id = :genre_id and movie_id = :movie_id";
        $parameters['genre_id'] = $genre_id;
        $parameters['movie_id'] = $movie_id;
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
            /*$result = $this->mapear($resultSet);
            $Genre = new Genre();
            $Genre->setId($result[0]->getId());
            $Genre->setDescription($result[0]->getDescription());*/
            return true; //TODO fijarse si se necesita una clase para generobymovies
            
        }else
            return false;
    }
}
      
?>