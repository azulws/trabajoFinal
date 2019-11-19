<?php
    namespace DAO;
    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use DAO\CinemaDBDAO as CinemaDBDAO;
    use Models\Room as Room;

    class RoomDBDAO
    {
         
         private $connection;
         private $cinemaDBDAO;
         private $tablename = "rooms";

         public function __construct()
         {
            $this->connection = null;
            $this->cinemaDBDAO = new CinemaDBDAO();
         }

         
      public function readAllByCinema($cinemaId){
        $sql = "SELECT * FROM $this->tablename WHERE cinema_id = :cinema_id";
        $parameter['cinema_id'] = $cinemaId;

        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql,$parameter);
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
        $roomList = array();
        foreach($value as $v){
            $room = new Room();
            $room->setName($v['room_name']);
            $room->setCapacity($v['capacity']);
            $room->setId($v['room_id']);
            $cinema = $this->cinemaDBDAO->read($v['cinema_id']);
            $room->setCinema($cinema);
            array_push($roomList,$room);
        }
        if(count($roomList)>0)
            return $roomList;
        else
            return false;
     }

    public function Add($room){

        $sql = "INSERT INTO $this->tablename (room_name,capacity,cinema_id) VALUES (:room_name,:capacity,:cinema_id)";

        $parameters['room_name'] = $room->getName();
        $parameters['capacity'] = $room->getCapacity();
        $parameters['cinema_id'] = $room->getCinema()->getId();

        try
        {
                $this->connection = Connection::getInstance();
                $result = $this->connection->ExecuteNonQuery($sql, $parameters);
                if($result)
                    return $result;
                else
                 return false;
                
         }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    public function Remove($id){
        $sql = "DELETE FROM $this->tablename WHERE room_id = :room_id";
        $parameters['room_id'] = $id;
        
        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    public function Update($room){

      $sql = "UPDATE $this->tablename SET room_name = :room_name, capacity = :capacity  WHERE room_id = :room_id";
      
      $parameters['room_name'] = $room->getName();
      $parameters['capacity'] = $room->getCapacity();
      $parameters['room_id'] = $room->getId();

      try{
        $this->connection = Connection::getInstance();
        return $this->connection->ExecuteNonQuery($sql, $parameters);
      }
      catch(PDOException $e){
        echo $e;
      }
    }

    public function read ($id)
    {
        $sql = "SELECT * FROM $this->tablename where room_id = :room_id";
        $parameters['room_id'] = $id;
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql, $parameters);
            if(!empty($resultSet))
            {
                 $response = $this->mapear($resultSet);
                 return $response[0];  
             }else
                return false;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    public function existsByName ($room)
    {
        $sql = "SELECT * FROM $this->tablename where room_name = :room_name and cinema_id = :cinema_id";
        $parameters['room_name'] = $room->getName();
        $parameters['cinema_id'] = $room->getCinema()->getId();
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->ExecuteNonQuery($sql, $parameters);
            if(!empty($resultSet))
            {
                return true;  
             }else
                return false;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
        
    }
}

