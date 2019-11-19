<?php
    namespace DAO;
    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use DAO\RoomDBDAO as RoomDBDAO;
    use DAO\MovieDBDAO as MovieDBDAO;
    use Models\Room as Room;
    use Models\Movie as Movie;
    use Models\MovieFunction as MovieFunction;
    

    class MovieFunctionDBDAO
    {
         
      private $connection;
      private $roomDBDAO;
      private $movieDBDAO;
      private $tablename = "movieFunctions";

        public function __construct()
         {
            $this->connection = null;
            $this->roomDBDAO = new RoomDBDAO();
            $this->movieDBDAO = new MovieDBDAO();
         }

         
    public function readAll()
    {
        $sql = "SELECT * FROM $this->tablename ORDER BY movie_id";
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

    public function readAllFunctionsByCinemaId($id)
    {
        $sql = "SELECT * FROM $this->tablename m 
        JOIN rooms r
            on r.room_id = m.room_id
        JOIN cinemas c
            on r.cinema_id = c.cinema_id
        WHERE c.cinema_id = :cinema_id ORDER BY m.start_datetime;";
        $params['cinema_id'] = $id;
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql,$params);
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

    public function functionsExistsInRoom($id)
    {
        $sql = "SELECT * FROM $this->tablename WHERE room_id = :room_id ORDER BY start_datetime;";
        $params['room_id'] = $id;
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->ExecuteNonQuery($sql,$params);
            if (!empty($resultSet))
            return true;
         else 
            return false;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }   

    public function readAllFunctionsByMovieId($id)
    {
        $sql = "SELECT * FROM $this->tablename WHERE movie_id = :movie_id ORDER BY start_datetime";
        $params['movie_id'] = $id;
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql,$params);
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
            $room = $this->roomDBDAO->read($v['room_id']);
            $movieFunction->setRoom($room);
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
        $sql = "INSERT INTO $this->tablename(start_datetime,room_id,movie_id)
        VALUES (:start_datetime,:room_id,:movie_id)";
        
        $parameters['start_datetime'] = $movieFunction->getStartDateTime();
        $parameters['room_id'] = $movieFunction->getRoom()->getId();
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
        $sql = "SELECT * FROM $this->tablename WHERE movieFunction_id = :movieFunction_id";
        $parameters['movieFunction_id'] = $movieFunctionId;
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql, $parameters);
            if(!empty($resultSet))
            {
                $result = $this->mapear($resultSet);
                $movieFunction = new MovieFunction();
                $movieFunction->setMovieFunctionId($result[0]->getMovieFunctionId());
                $room = $this->roomDBDAO->read($result[0]->getRoom()->getId());
                $movieFunction->setRoom($room);
                $movie = $this->movieDBDAO->read($result[0]->getMovie()->getId());
                $movieFunction->setMovie($movie);
                $movieFunction->setStartDateTime($result[0]->getStartDateTime());
                return $movieFunction;
                
            }else
         
            return false;
        }
        catch(PDOException $e)
        {
            echo $e;
        }

    }

    public function validateMovieFunctionDate($room_id,$startDateTime)
    {
        $sql = "SELECT * FROM $this->tablename WHERE room_id = :room_id AND start_datetime LIKE '".$startDateTime."%' ";
        //$parameters['startDateTime'] = $startDateTime;
        $parameters['room_id'] = $room_id;
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
        $sql = "SELECT * FROM $this->tablename WHERE movie_id = :movie_id AND start_datetime LIKE '".$startDateTime."%' ";
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