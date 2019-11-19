<?php
    namespace DAO;

    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\Ticket as Ticket;
    use Models\MovieFunction as MovieFunction;
    use DAO\MovieFunctionDBDAO as MovieFunctionDBDAO;
    use DAO\BuyoutDBDAO as BuyoutDBDAO;

    class TicketDBDAO
        {
         
        private $connection;
        private $movieFunctionDBDAO;
        private $buyoutDBDAO;
        private $tablename = "tickets";

        public function __construct()
        {
            $this->connection = null;
            $this->buyoutDBDAO = new BuyoutDBDAO();
            $this->movieFunctionDBDAO= new MovieFunctionDBDAO();
        }  
       public function readAllByUser($user){
        $sql = "SELECT t.ticket_id, t.qr, t.movieFunction_id, b.buyout_id FROM $this->tablename as t 
        JOIN buyouts as b on b.buyout_id=t.buyout_id 
        WHERE b.user_email = :email";
        $parameters['email']= $user->getEmail();
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

       public function readAllByMovieFunction($movieFunctionId){
            $sql = "SELECT b.buyout_id, b.user_email, b.buy_date,b.cantTicket, b.total, b.discount FROM $this->tablename as t 
            JOIN buyouts as b on b.buyout_id=t.buyout_id 
            WHERE t.movieFunction_id = :movieFunctionId GROUP BY t.buyout_id";
            $parameters['movieFunctionId']= $movieFunctionId;
            try
            {
                $this->connection = Connection::getInstance();
                $resultSet = $this->connection->execute($sql,$parameters);
                if (!empty($resultSet))
                return $this->mapearAux($resultSet);
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
               $buyout = $this->buyoutDBDAO->read($v['buyout_id']);
               $ticket->setBuyout($buyout);
               $movieFunction = $this->movieFunctionDBDAO->read($v['movieFunction_id']);
               $ticket->setMovieFunction($movieFunction);
               array_push($ticketList,$ticket);
           }
           if(count($ticketList)>0)
               return $ticketList;
           else
               return false;
        }

        protected function mapearAux($value) {
            $ticketList = array();
            foreach($value as $v){
                $ticket = new Ticket();
                $buyout = $this->buyoutDBDAO->read($v['buyout_id']);
                $ticket->setBuyout($buyout);
                array_push($ticketList,$ticket);
            }
            if(count($ticketList)>0)
                return $ticketList;
            else
                return false;
         }
   
       public function Add($ticket){
   
           $sql = "INSERT INTO $this->tablename (qr,movieFunction_id,buyout_id) VALUES (:qr,:movieFunction_id,:buyout_id)";
   
           $parameters['qr'] = $ticket->getQr();
           $parameters['movieFunction_id'] = $ticket->getMovieFunction()->getMovieFunctionId();
           $parameters['buyout_id'] = $ticket->getBuyout()->getId();
   
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
      
       public function read ($id)
       {
           $sql = "SELECT * FROM $this->tablename where cantTicket = :id";
           $parameters['id'] = $id;
           try
           {
               $this->connection = Connection::getInstance();
               $resultSet = $this->connection->execute($sql, $parameters);
               if(!empty($resultSet))
               {
                   $result = $this->mapear($resultSet);
                   $ticket = new Ticket();
                   $ticket->setId($result[0]->getId());
                   $ticket->setQr($result[0]->getQr());
                   $movieFunction = $this->movieFunctionDBDAO->read($result[0]->getMovieFunctionId());
                   $ticket->setMovieFunction($movieFunction);
                   $ticket->setBuyout($result[0]->getBuyout());
                   return $ticket;
               }else
                   return false;
           }
           catch(PDOException $e)
           {
               echo $e;
           }
          
       }

       public function readLast ()
       {
           $sql = "SELECT * FROM $this->tablename ORDER BY ticket_id DESC limit 1";
           try
           {
               $this->connection = Connection::getInstance();
               $resultSet = $this->connection->execute($sql);
               if(!empty($resultSet))
               {
                   $result = $this->mapear($resultSet);
                   $ticket = new Ticket();
                   $ticket->setId($result[0]->getId());
                   $ticket->setQr($result[0]->getQr());
                   $movieFunction = $this->movieFunctionDBDAO->read($result[0]->getMovieFunction()->getMovieFunctionId());
                   $ticket->setMovieFunction($movieFunction);
                   $ticket->setBuyout($result[0]->getBuyout());
                   return $ticket;
               }else
                   return false;
           }
           catch(PDOException $e)
           {
               echo $e;
           }
          
       }

       public function Update ($ticket){
        $sql = "UPDATE $this->tablename SET qr = :qr, movieFunction_id = :movieFunction_id, buyout_id = :buyout_id WHERE ticket_id = :ticket_id";
        $parameters['qr'] = $ticket->getqr();
        $parameters['movieFunction_id'] = $ticket->getmovieFunction()->getMovieFunctionId();
        $parameters['buyout_id'] = $ticket->getBuyout()->getId();
        $parameters['ticket_id'] = $ticket->getId();
    
        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $e){
            echo $e;
        }
       }

       public function countTicketsForFunction($movieFunction){
           $sql = "SELECT * FROM $this->tablename WHERE movieFunction_id = :id";
           $parameters['id']=$movieFunction->getMovieFunctionId();
           try{
               $this->connection = Connection::getInstance();
               return $resultSet = $this->connection->ExecuteNonQuery($sql,$parameters);
           }
           catch(PDOException $e){
               echo $e;
           }
       }
   }
