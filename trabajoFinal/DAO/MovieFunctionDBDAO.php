<?php
    namespace DAO;
    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use DAO\CinemaDBDAO as CinemaDBDAO;
    use DAO\MovieDBDAO as MovieDBDAO;
    use Models\Cinema as Cinema;
    use Models\Movie as Movie;
    use Models\MovieFunction as MovieFunction;
    

    class MovieFunctionDBDAO
    {
         
      private $connection;
      private $cinemaDBDAO;
      private $movieDBDAO;
      private $tablename="movieFunctions";

        public function __construct()
         {
            $this->connection = null;
            $this->cinemaDBDAO = new CinemaDBDAO();
            $this->movieDBDAO = new MovieDBDAO();
         }

         
    public function readAll()
    {
        $sql = "SELECT * FROM $this->tablename ";
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql);
            if (!empty($resultSet))
            return $this->mapear($resultSet);
            else 
            return false;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
        
    }  

    public function readAllMovies()
    {
        $sql = "SELECT movie_id FROM movieFunctions GROUP BY movie_id";
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql);
            if (!empty($resultSet))
            return $resultSet;
             else 
             return false;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
        
    }
    
    public function readAllMoviesByGenres($genre)
    {
        $sql = "SELECT m.movie_id FROM $this->tablename as m JOIN genresByMovies as gbm 
        on m.movie_id = gbm.movie_id WHERE gbm.genre_id = :genreId GROUP BY m.movie_id";
        $parameters['genreId'] = $genre->getId();

        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql,$parameters);
            if (!empty($resultSet))
            return $resultSet;
            else 
            return false;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
        
    }  

    public function readOrderByTime()
    {
        $sql = "SELECT * FROM $this->tablename ORDER BY start_datetime";
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql);
            if (!empty($resultSet))
            return $this->mapear($resultSet);
            else 
            return false;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
        
    }  
    
    protected function mapear($value)
     {

        
        $movieFunctionList = array();
        foreach($value as $v)
        {
            $movieFunction = new MovieFunction();
            $movieFunction->setMovieFunctionId($v["movieFunction_id"]);
            $cinema = $this->cinemaDBDAO->read($v['cinema_id']);
            $movieFunction->setCinema($cinema);
            $movie = $this->movieDBDAO->read($v['movie_id']);
            $movieFunction->setMovie($movie);
            $movieFunction->setStartDateTime($v['start_datetime']);
            array_push($movieFunctionList,$movieFunction);
        }
        if(count($movieFunctionList)>0)
            return $movieFunctionList;
        else
            return false;
     }

      public function Add($movieFunction)
       {
        $sql = "INSERT INTO movieFunctions (start_datetime,cinema_id,movie_id)
        VALUES (:start_datetime,:cinema_id,:movie_id)";

         var_dump($movieFunction);
        $parameters['start_datetime'] = $movieFunction->getStartDateTime();
        $parameters['cinema_id'] = $movieFunction->getCinema()->getId();
        $parameters['movie_id'] = $movieFunction->getMovie()->getId();

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

    public function Remove($movieFunctionId) 
    {
        $sql = "DELETE FROM $this->tablename WHERE  movieFunction_id = :movieFunction_id";
        $parameters['movieFunction_id'] = $movieFunctionId;
        
        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $e){
            echo $e;
        }
    }

    public function read ($movieFunctionId)
    {
        $sql = "SELECT * FROM movieFunctions where movieFunction_id = :movieFunction_id";
        $parameters['movieFunction_id'] = $movieFunctionId;
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql, $parameters);
            if(!empty($resultSet))
            {
                $result = $this->mapear($resultSet);
                $movieFunction = new MovieFunctions();
                $movieFunction->setMovieFunctionId($result[0]->getMovieFunctionId());
                $movieFunction->setCinema($this->cienemaDBDAO->read($result[0]->getId()));
                $movieFunction->setMovie($this->movieDBDAO->read($result[0]->getMovieId()));
                $movieFunction->setStartDateTime($result[0]->getStartTime());
                return $movieFunction;  
        }else
     
        return false;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
        
    }
    //esta es otr funcion
    public function readOrderByCinemaId($cinema_id)
    {
        $sql = "SELECT * FROM  $this->tablename WHERE cinema_id = :cinema_id";
        $parameters['cinema_id']= $cinema_id;
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql,$parameters);
            if (!empty($resultSet))
            return $this->mapear($resultSet);
            else 
            return false;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }
    public function validateMovieFunctionDate($cinema_id,$startDateTime)
    {
        $sql = "SELECT * FROM movieFunctions WHERE cinema_id = :cinema_id AND start_datetime LIKE '".$startDateTime."%' ";
        //$parameters['startDateTime'] = $startDateTime;
        $parameters['cinema_id'] = $cinema_id;
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql,$parameters);
            if (!empty($resultSet))
            return $this->mapear($resultSet);
         else 
            return false;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
       
    }  
    public function validateMovieFunctionDateByMovie($movie_id,$startDateTime)
    {
        $sql = "SELECT * FROM movieFunctions WHERE movie_id = :movie_id AND start_datetime LIKE '".$startDateTime."%' ";
        //$parameters['startDateTime'] = $startDateTime;
        $parameters['movie_id'] = $movie_id;
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql,$parameters);
            if (!empty($resultSet))
            return $this->mapear($resultSet);
         else 
            return false;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
       
    }  
}    
     
?>