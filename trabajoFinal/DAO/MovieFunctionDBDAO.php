<?php
    namespace DAO;
    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\Cinema as Cinema;
    use Models\Movie as Movie;
    use Models\MovieFunction as MovieFunction;

    class MovieFunction()
    {
         
      private $connection;

      public function __construct()
         {
            $this->connection = null;
         }

         
      public function readAll()
      {
        $sql = "SELECT * FROM movieFunctions";
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

    protected function mapear($value)
     {

        
        $movieFunctionList = array();
        foreach($value as $v)
        {
            $movieFunction = new MovieFunction();
            $movieFunction->setMovieFunctionId ($v['movieFuntion_id']);
            $movieFunction->setCinemaId($v['cinema_id']);
            $movieFunction->setStartDateTime($v['startDateTime']);
            array_push($movieFunctionList,$movieFunction);
        }
        echo count($movieFunctionList);
        if(count($movieFunctionList)>0)
            return $movieFunctionList;
        else
            return false;
     }

      public function Add($movieFunction) // movieFuntion is an object
       {
        // Guardo como string la consulta sql utilizando como value, marcadores de parámetros con name (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada 

        $sql = "INSERT INTO movieFuntions( movieFuntion_id, start_datetime, cinema_id, movie_id) VALUES (:movieFuntion_id, :start_datetime, :cinema_id, :movie_id)";

        $parameters['movieFunction_id'] = $movieFunction->getMovieFuntionId();
        $parameters['startDateTime'] = $movieFunction-> getStartDateTime();
        $parameters['cinema_id'] = $movieFunction->getCinemaId();
        $parameters['movie_id'] = $movieFunction->getMovieId();

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

    public function Remove($movieFunction) //$movieFuntion is an object
    {
        $sql = "DELETE FROM movieFuntions WHERE  movieFunction_id = :movieFuntion_id";
        $parameters['movieFuntions_id'] = $movieFunction->getMovieFunctionId();
        
        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    public function Update($movieFuntionId,$starDatetime,$cinema, $movie){ //cinema and movie are objects

      $sql = "UPDATE movieFuntions SET movie_id = :movie_id, cinema_id = :cinema_id WHERE movieFunction_Id = :movieFunction_Id";
    
      $parameters['cinema_id'] = $cinema->getCinemaId();
      $parameters['movie_id'] = $movie->getMovieId();
      $parameters['startDateTime'] = $startDateTime;

      try{
        $this->connection = Connection::getInstance();
        return $this->connection->ExecuteNonQuery($sql, $parameters);
      }
      catch(PDOException $e){
        echo $e;
      }
    }
    public function read ($movieFuntion)
    {
        $sql = "SELECT * FROM movieFunctions where movieFunction_id = :movieFucntion_id";
        $parameters['movieFunction_id'] = $movieFunction->getMovieFuntionId();
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
            $movieFunction = new MovieFuntions();
            $movieFunction->setMovieFunctionId($result[0]->getMovieFuntionId());
            $movieFunction->setCinema($result[0]->getCinema());
            $movieFunction->setMovie($result[0]->getMovie());
            $movieFunction->setStartDateTime($result[0]->getStartTime());
            return $movieFuntion;
            
        }else
     
        return false;
    }
       
?>