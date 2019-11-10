<?php
    namespace DAO;

    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\Ticket as Ticket;
    use Models\MovieFunction as MovieFunction;
    use DAO\MovieFunctionDBDAO as MovieFunctionDBDAO;

    class TicketDBDAO
        {
         
        private $connection;
        private $movieFunctionDBDAO;
        private $tablename = "tickets";

        public function __construct()
        {
            $this->connection = null;
            $this->movieFunctionDBDAO= new MovieFunctionDBDAO();
        }

        public function readAll(){
        $sql = "SELECT * FROM $this->tablename ORDER BY ticket_id";
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
   
       protected function mapear($value) {
   
           
           $ticketList = array();
           foreach($value as $v){
               $ticket = new Ticket();
               $ticket->setId($v['ticket_id']);
               $ticket->setQr($v['qr']);
               $movieFunction = $this->movieFunctionDBDAO->read($v['movieFunction_id']);
               $ticket->setMovieFunction($movieFunction);
               array_push($ticketList,$ticket);
           }
           if(count($ticketList)>0)
               return $ticketList;
           else
               return false;
        }
   
       public function Add($ticket){
   
           $sql = "INSERT INTO $this->tablename (qr,movieFunction_id) VALUES (:qr,:movieFunction_id)";
   
           $parameters['qr'] = $ticket->getQr();
           $parameters['movieFunction_id'] = $ticket->getMovieFunction()->getMovieFunctionId();
   
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
           $sql = "DELETE FROM $this->tablename WHERE ticket_id = :id";
           $parameters['id'] = $id;
           
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
           $sql = "SELECT * FROM $this->tablename tickets where ticket_id = :id";
           $parameters['id'] = $id;
           try
           {
               $this->connection = Connection::getInstance();
               $resultSet = $this->connection->execute($sql, $parameters);
               if(!empty($resultSet))
               {
                   $result = $this->mapear($resultSet);
                   $ticket = new Ticket();
                   $ticket->setQr($result[0]->getQr());
                   $movieFunction = $this->movieFunctionDBDAO->read($result[0]->getMovieFunctionId());
                   $ticket->setMovieFunction($movieFunction);
                   return $ticket;
               }else
                   return false;
           }
           catch(PDOException $e)
           {
               echo $e;
           }
          
       }

   }
