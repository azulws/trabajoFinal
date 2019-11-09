<?php
    namespace DAO;

    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\Buyout as Buyout;
    //use Models\User as User;
    //use DAO\UserDBDAO as UserDBDAO;
    //use Models\CreditCard as CreditCard;
    //use DAO\CreditCardDBDAO as CreditCardDBDAO;
    //use Models\Ticket as Ticket;
    //use DAO\TicketDBDAO as TicketDBDAO;

    class BuyoutDBDAO{
        {
         
        private $connection;

        public function __construct()
        {
            $this->connection = null;
        }

        public function readAll(){
        $sql = "SELECT * FROM buyouts ORDER BY buyout_id";
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
   
           
           $buyoutList = array();
           foreach($value as $v){
               $buyout = new Buyout();
               $buyout->setId($v['buyout_id']);
               $buyout->setDiscound($v['discound']);
               $buyout->setBuyDate($v['buy_date']);
               $buyout->setTotal($v['total']);
               $buyout->setTicket($ticket);
               $buyout->setUser($user);
               $buyout->setCreditCard($creditCard);
               array_push($buyoutList,$buyout);
           }
           if(count($buyoutList)>0)
               return $buyoutList;
           else
               return false;
        }
   
       public function Add($buyout){
   
           $sql = "INSERT INTO buyouts (discound,buy_date,total,ticket_id,user_id,creditCard_id) 
           VALUES (:discound, :buy_date, :total, :ticket_id, :user_id, :creditCard_id)";
   
           $parameters['discound'] = $buyout->getDiscound();
           $parameters['buy_date'] = $buyout->getBuyDate();
           $parameters['total'] = $buyout->getTotal();
           $parameters['ticket_id'] = $buyout->getTicket();
           $parameters['user_id'] = $buyout->getUser();
           $parameters['creditCard_id'] = $buyout->getCreditCard();
   
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
           $sql = "DELETE FROM buyouts WHERE buyout_id = :id";
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
           $sql = "SELECT * FROM buyouts where buyout_id = :id";
           $parameters['id'] = $id;
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
               $buyout = new Buyout();
               $buyout->setDiscound($result[0]->getDiscound());
               $buyout->setBuyDate($result[0]->getBuyDate());
               $buyout->setTotal($result[0]->getTotal());
               $buyout->setTicket($result[0]->getTicket());
               $buyout->setUser($result[0]->getUser());
               $buyout->setCreditCard($result[0]->getCreditCard());
               return $buyout;
           }else
               return false;
       }

   }