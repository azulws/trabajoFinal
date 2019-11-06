<?php
    namespace DAO;
    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\Cinema as Cinema;
    use Models\Movie as Movie;
    use Models\MovieFunction as MovieFunction;
    use DAO\CinemaDBDAO as CinemaDBDAO;
    use DAO\MovieDBDAO as MovieDBDAO;

    class MovieFunctionDBDAO
    {
         
      private $connection;
      private $cinemaDBDAO;
      private $movieDBDAO;

      private $tablename = "movieFunctions";

        public function __construct()
         {
            $this->connection = null;
            $this->cinemaDBDAO = new CinemaDBDAO();
            $this->movieDBDAO = new MovieDBDAO();

         }

         
    public function readAll()
    {
        $sql = "SELECT * FROM $this->tablename";
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
        $sql = "SELECT movie_id FROM $this->tablename GROUP BY movie_id";
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
        $sql = "SELECT m.movie_id FROM $this->tablename as m JOIN genresByMovies as gbm 
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
        $sql = "SELECT * FROM $this->tablename ORDER BY start_datetime";
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
            $movieFunction->setCinema($this->cinemaDBDAO->read($v['cinema_id']));
            $movieFunction->setMovie($this->movieDBDAO->read($v['movie_id']));
            $movieFunction->setStartDateTime($v['start_datetime']);
            //setEndDateTime $this->getMovieFunctionEndTime//
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

        $sql = "INSERT INTO $this->tablename (start_datetime,cinema_id,movie_id)
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

    public function read ($movieFunction_id)
    {
        $sql = "SELECT * FROM $this->tablename  where movieFunction_id = :movieFunction_id";
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
            return $movieFunction;
            
        }else
     
        return false;
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