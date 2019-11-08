<?php
    namespace DAO;
    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\Cinema as Cinema;
    use Models\Movie as Movie;
    use Models\MovieFunction as MovieFunction;

    class MovieFunctionDBDAO
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

    public function readAllMovies()
    {
        $sql = "SELECT movie_id FROM movieFunctions GROUP BY movie_id";
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
           return $resultSet;
        else 
           return false;
    }
    
    public function readAllMoviesByGenres($genreId)
    {
        $sql = "SELECT m.movie_id FROM movieFunctions as m JOIN genresByMovies as gbm 
        on m.movie_id = gbm.movie_id WHERE gbm.genre_id = :genreId GROUP BY m.movie_id";
        $parameters['genreId'] = $genreId;

        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql,$parameters);
        }
        catch(PDOException $e)
        {
            echo $e;
        }
        if (!empty($resultSet))
           return $resultSet;
        else 
           return false;
    }  

    public function readOrderByTime()
    {
        $sql = "SELECT * FROM movieFunctions ORDER BY start_datetime";
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
            $movieFunction->setMovieFunctionId($v['movieFunction_id']);
            $movieFunction->setCinemaId($v['cinema_id']);
            $movieFunction->setMovieId($v['movie_id']);
            $movieFunction->setStartDateTime($v['start_datetime']);
            //setEndDateTime
            array_push($movieFunctionList,$movieFunction);
        }
        if(count($movieFunctionList)>0)
            return $movieFunctionList;
        else
            return false;
     }

      public function Add(MovieFunction $movieFunction) // movieFunction is an object
       {
        // Guardo como string la consulta sql utilizando como value, marcadores de parámetros con name (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada 

        $sql = "INSERT INTO movieFunctions(start_datetime,cinema_id,movie_id)
        VALUES (:start_datetime,:cinema_id,:movie_id)";


        $parameters['start_datetime'] = $movieFunction->getStartDateTime();
        $parameters['cinema'] = $movieFunction->getCinemaId();
        $parameters['movie'] = $movieFunction->getMovieId();

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
        $sql = "DELETE FROM movieFunctions WHERE  movieFunction_id = :movieFunction_id";
        $parameters['movieFunction_id'] = $movieFunctionId;
        
        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $e){
            echo $e;
        }
    }

    public function read ($movieFunction_id)
    {
        $sql = "SELECT * FROM movieFunctions where movieFunction_id = :movieFunction_id";
        $parameters['movieFunction_id'] = $movieFunction_id;
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
            $movieFunction = new MovieFunctions();
            $movieFunction->setMovieFunctionId($result[0]->getMovieFunctionId());
            $movieFunction->setCinemaId($result[0]->getCinemaId());
            $movieFunction->setMovieId($result[0]->getMovieId());
            $movieFunction->setStartDateTime($result[0]->getStartTime());
           // $movieFunction->setEndDateTime($result[0]->getEndTime()); esto en la controller
            return $movieFunction;
            
        }else
     
        return false;
    }
    //esta es otr funcion
    public function readOrderByCinemaId($cinema_id)
    {
        $sql = "SELECT * FROM movieFunctions WHERE cinema_id = :cinema_id";
        $parameters['cinema_id']= $cinema_id;
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql,$parameters);
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