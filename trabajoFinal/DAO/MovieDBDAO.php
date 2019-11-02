<?php
    namespace DAO;
    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\Movie as Movie;
    use DAO\GenresByMoviesDBDAO as GenresByMoviesDBDAO;

    class MovieDBDAO
    {
         
         private $connection;
         private $genresByMoviesDBDAO;

         public function __construct()
         {
            $this->connection = null;
            $this->genresByMoviesDBDAO = new GenresByMoviesDBDAO();
         }

         
      public function readAll(){
        $sql = "SELECT * FROM movies";
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql);
        }
        catch(PDOException $e)
        {
            echo $e;
        }
        if (!empty($resultSet))
           return $this->mapear($resultSet);
        else 
           return false;
    }  

    protected function mapear($value) {

        $movieList = array();
        foreach($value as $v){
            $movie = new Movie();
            $movie->setTitle($v['title']);
            $movie->setReleaseDate($v['release_date']);
            $movie->setPoster($v['poster']);
            $movie->setDescription($v['movie_description']);
            $movie->setPoints($v['points']);
            $movie->setMovieId($v['movie_id']);
            $movie->setRuntime($v['runtime']);
            array_push($movieList,$movie);
        }
        if(count($movieList)>0)
            return $movieList;
        else
            return false;
     }

     public function writeAll($movieList){
         foreach($movieList as $movie){
            if($this->read($movie->getTitle())==false){
                $this->Add($movie);
                $this->genresByMoviesDBDAO->writeAll($movie);
            }    
         }
     }


    public function Add($movie){
        // Guardo como string la consulta sql utilizando como value, marcadores de parámetros con title$title (:title$title) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada 

        $sql = "INSERT INTO movies (title,release_date,points,poster,movie_description,movie_id,runtime)
        VALUES (:title, :release_date, :points,:poster, :movie_description, :movie_id, :runtime)";

        $parameters['title'] = $movie->getTitle();
        $parameters['release_date'] = $movie->getReleaseDate();
        $parameters['points'] = $movie->getPoints();
        $parameters['poster'] = $movie->getPoster();
        $parameters['movie_description'] = $movie->getDescription();
        $parameters['movie_id'] = $movie->getMovieId();
        $parameters['runtime'] = $movie->getRuntime();
        
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
/*
    public function Remove($title){
        $sql = "DELETE FROM Movies WHERE title = :title";
        $parameters['title'] = $title;
        
        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    public function Update($title,$release_date,$movie_description){

      $sql = "UPDATE Movies SET release_date = :release_date, movie_description = :movie_description WHERE title = :title";
      $parameters['title'] = $title;
      $parameters['release_date'] = $release_date;
      $parameters['movie_description'] = $movie_description;

      try{
        $this->connection = Connection::getInstance();
        return $this->connection->ExecuteNonQuery($sql, $parameters);
      }
      catch(PDOException $e){
        echo $e;
      }
    }*/
    public function read ($id)
    {
        $sql = "SELECT * FROM movies where movie_id = :movie_id";
        $parameters['movie_id'] = $id;
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
            $result = $this->mapear($resultSet);
            $movie = new Movie();
            $movie->setTitle($result[0]->getTitle());
            $movie->setReleaseDate($result[0]->getReleaseDate());
            $movie->setPoints($result[0]->getPoints());
            $movie->setPoster($result[0]->getposter());
            $movie->setDescription($result[0]->getDescription());
            $movie->setMovieId($result[0]->getMovieId());
            $movie->setRuntime($result[0]->getRuntime());

            return $movie;
            
        }else
            return false;
    }
    public function readOrderByDate(){
        $sql = "SELECT * FROM movies ORDER BY release_date DESC";
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql);
        }
        catch(PDOException $e)
        {
            echo $e;
        }
        if (!empty($resultSet))
           return $this->mapear($resultSet);
        else 
           return false;
    }
}
      
?>