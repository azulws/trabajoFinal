<?php
    namespace DAO;
    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\Genre as Genre;

    class GenreDBDAO
    {
         
         private $connection;

         public function __construct()
         {
            $this->connection = null;
         }

         
      public function readAll(){
        $sql = "SELECT * FROM genres";
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

        $genreList = array();
        foreach($value as $v){
            $Genre = new Genre();
            $Genre->setId($v['genre_id']);
            $Genre->setDescription($v['genre_description']);
            array_push($genreList,$Genre);
        }
        if(count($genreList)>0)
            return $genreList;
        else
            return false;
     }

    public function writeAll($genreList){
        foreach($genreList as $genre){
           if($this->read($genre->getId())==false)
               $this->Add($genre);
        }
    }


    public function Add($Genre){
        // Guardo como string la consulta sql utilizando como value, marcadores de parámetros con title$title (:title$title) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada 

        $sql = "INSERT INTO genres (genre_id,genre_description) 
        VALUES (:genre_id, :genre_description)";

        $parameters['genre_id'] = $Genre->getId();
        $parameters['genre_description'] = $Genre->getDescription();
        
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
        $sql = "SELECT * FROM genres where genre_id = :genre_id";
        $parameters['genre_id'] = $id;
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
            $Genre = new Genre();
            $Genre->setId($result[0]->getId());
            $Genre->setDescription($result[0]->getDescription());
            return $Genre;
            
        }else
            return false;
    }
}
      
?>