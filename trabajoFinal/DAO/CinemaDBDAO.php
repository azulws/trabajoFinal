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
         private $tablename = "cinemas";

         public function __construct()
         {
            $this->connection = null;
         }

         
      public function readAll(){
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

    protected function mapear($value) 
    {
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

    public function Add( Cinema $cinema){
        // Guardo como string la consulta sql utilizando como value, marcadores de parámetros con name (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada 

        $sql = "INSERT INTO $this->tablename (cinema_name,ticket_value,address,capacity) VALUES (:cinema_name, :ticket_value, :address, :capacity)";

        $parameters['cinema_name'] = $cinema->getName();
        $parameters['ticket_value'] = $cinema->getTicketValue();
        $parameters['address'] = $cinema->getAddress();
        $parameters['capacity'] = $cinema->getCapacity();

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
        $sql = "DELETE FROM $this->tablename WHERE cinema_id= :cinema_id";
        $parameters['cinema_id'] = $id;
        
        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    public function Update(Cinema $cinema){

      $sql = "UPDATE $this->tablename SET ticket_value = :ticket_value, capacity = :capacity WHERE cinema_name = :cinema_name";
      $parameters['cinema_name'] = $cinema->getName();
      $parameters['ticket_value'] = $cinema->getTicketValue();
      $parameters['capacity'] = $cinema->getCapacity();

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
        $sql = "SELECT * FROM $this->tablename where cinema_id = :cinema_id";
        $parameters['cinema_id'] = $id;
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql, $parameters);
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
        catch(PDOException $e)
        {
            echo $e;
        }
        
    }
}

