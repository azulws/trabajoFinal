<?php
    namespace DAO;
    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\Cinema as Cinema;

    class cinemaDBDAO
    {
         
         private $connection;

         public function __construct()
         {
            $this->connection = null;
         }

         
      public function readAll(){
        $sql = "SELECT * FROM cinemas";
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

        
        $cinemaList = array();
        foreach($value as $v){
            $cinema = new Cinema();
            $cinema->setName($v['cinema_name']);
            $cinema->setTicketValue($v['ticket_value']);
            $cinema->setAddress($v['address']);
            $cinema->setCapacity($v['capacity']);
            $cinema->setId($v['cinema_id']);
            array_push($cinemaList,$cinema);
        }
        if(count($cinemaList)>0)
            return $cinemaList;
        else
            return false;
     }

    public function Add($cinema){

        $sql = "INSERT INTO cinemas (cinema_name,ticket_value,address,capacity) VALUES (:cinema_name, :ticket_value, :address, :capacity)";

        $parameters['cinema_name'] = $cinema->getName();
        $parameters['ticket_value'] = $cinema->getTicketValue();
        $parameters['address'] = $cinema->getAddress();
        $parameters['capacity'] = $cinema->getCapacity();

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

    public function Remove($id){
        $sql = "DELETE FROM cinemas WHERE cinema_id = :cinema_id";
        $parameters['cinema_id'] = $id;
        
        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    public function Update($cinema){

      $sql = "UPDATE cinemas SET ticket_value = :ticket_value, capacity = :capacity, address = :address, cinema_name = :cinema_name WHERE cinema_id = :cinema_id";
      $parameters['cinema_name'] = $cinema->getName();
      $parameters['ticket_value'] = $cinema->getTicketValue();
      $parameters['capacity'] = $cinema->getCapacity();
      $parameters['address'] = $cinema->getAddress();
      $parameters['cinema_id'] = $cinema->getId();

      try{
        $this->connection = Connection::getInstance();
        return $this->connection->ExecuteNonQuery($sql, $parameters);
      }
      catch(PDOException $e){
        echo $e;
      }
    }
    public function readById($id)
    {
        $sql = "SELECT * FROM cinemas where cinema_id = :cinema_id";
        $parameters['cinema_id'] = $id;
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
            $cinema = new Cinema();
            $cinema->setName($result[0]->getName());
            $cinema->setTicketValue($result[0]->getTicketValue());
            $cinema->setAddress($result[0]->getAddress());
            $cinema->setCapacity($result[0]->getCapacity());
            $cinema->setId($result[0]->getId());
            return $cinema;
            
        }else
            return false;
    }

    public function readByName ($name)
    {
        $sql = "SELECT * FROM cinemas where cinema_name = :cinema_name";
        $parameters['cinema_name'] = $name;
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
            $cinema = new Cinema();
            $cinema->setName($result[0]->getName());
            $cinema->setTicketValue($result[0]->getTicketValue());
            $cinema->setAddress($result[0]->getAddress());
            $cinema->setCapacity($result[0]->getCapacity());
            $cinema->setId($result[0]->getId());
            return $cinema;
            
        }else
            return false;
    }
}

       
?>