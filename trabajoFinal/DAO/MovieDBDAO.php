<?php
    namespace DAO;
    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\Movie;

    class MovieDBDAO
    {
         
         private $connection;

         public function __construct()
         {
            $this->connection = null;
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

        $MovieList = array();
        foreach($value as $v){
            $Movie = new Movie();
            $Movie->setTitle($v['title']);
            $Movie->setReleaseDate($v['release_date']);
            $Movie->setPoster($v['poster']);
            $Movie->setDescription($v['movie_description']);
            $Movie->setPoints($v['points']);
            $Movie->setMovieId($v['movie_id']);
            array_push($MovieList,$Movie);
        }
        if(count($MovieList)>0)
            return $MovieList;
        else
            return false;
     }

    public function Add($Movie){
        // Guardo como string la consulta sql utilizando como value, marcadores de parámetros con title$title (:title$title) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada 

        $sql = "INSERT INTO movies (title,release_date,points,poster,movie_description,movie_id) 
        VALUES (:title, :release_date, :points,:poster, :movie_description, :movie_id)";

        $parameters['title'] = $Movie->getTitle();
        $parameters['release_date'] = $Movie->getReleaseDate();
        $parameters['points'] = $Movie->getPoints();
        $parameters['poster'] = $Movie->getPoster();
        $parameters['movie_description'] = $Movie->getDescription();
        $parameters['movie_id'] = $Movie->getMovieId();
        
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
    public function read ($title)
    {
        $sql = "SELECT * FROM movies where title = :title";
        $parameters['title'] = $title;
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
            $Movie = new Movie();
            $Movie->setTitle($result[0]->getTitle());
            $Movie->setReleaseDate($result[0]->getReleaseDate());
            $Movie->setPoints($result[0]->getPoints());
            $Movie->setPoster($result[0]->getposter());
            $Movie->setDescription($result[0]->getDescription());
            $Movie->setMovieId($result[0]->getMovieId());
            return $Movie;
            
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