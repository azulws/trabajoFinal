<?php
    namespace DAO;

    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\Buyout as Buyout;
    use Models\User as User;
    use DAO\UserDBDAO as UserDBDAO;
    use Models\CreditCard as CreditCard;
    use DAO\CreditCardDBDAO as CreditCardDBDAO;
    use Models\Ticket as Ticket;
    use DAO\TicketDBDAO as TicketDBDAO;

    class BuyoutDBDAO{
         
        private $connection;
        private $userDBDAO;
        private $creditCardDBDAO;
        private $ticketDBDAO;
        private $tablename = "buyouts";

        public function __construct()
        {
            $this->connection = null;
            $this->userDBDAO = new UserDBDAO();
            $this->creditCardDBDAO = new CreditCardDBDAO();
            $this->ticketDBDAO = new TicketDBDAO();
        }

        public function readAll(){
        $sql = "SELECT * FROM $this->tablename ORDER BY buyout_id";
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
   
           
           $buyoutList = array();
           foreach($value as $v){
               $buyout = new Buyout();
               $buyout->setId($v['buyout_id']);
               $buyout->setDiscound($v['discound']);
               $buyout->setBuyDate($v['buy_date']);
               $buyout->setTotal($v['total']);
               $ticket = $this->ticketDBDAO->read($v['ticket_id']);
               $buyout->setTicket($ticket);
               $user = $this->userDBDAO->read($v['user_email']);
               $buyout->setUser($user);
               $creditCard = $this->creditCardDBDAO->read($v['creditCard_id']);
               $buyout->setCreditCard($creditCard);
               array_push($buyoutList,$buyout);
           }
           if(count($buyoutList)>0)
               return $buyoutList;
           else
               return false;
        }
   
       public function Add($buyout){
   
           $sql = "INSERT INTO $this->tablename (discound,buy_date,total,ticket_id,user_email,creditCard_id) 
           VALUES (:discound, :buy_date, :total, :ticket_id, :user_email, :creditCard_id)";
   
           $parameters['discound'] = $buyout->getDiscound();
           $parameters['buy_date'] = $buyout->getBuyDate();
           $parameters['total'] = $buyout->getTotal();
           $parameters['ticket_id'] = $buyout->getTicket()->getId();
           $parameters['user_email'] = $buyout->getUser()->getEmail();
           $parameters['creditCard_id'] = $buyout->getCreditCard()->getId();
   
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
           $sql = "DELETE FROM $this->tablename WHERE buyout_id = :id";
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
           $sql = "SELECT * FROM $this->tablename where buyout_id = :id";
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
               $ticket = $this->ticketDBDAO->read($result[0]->getId());
               $buyout->setTicket($ticket);
               $user = $this->userDBDAO->read($result[0]->getEmail());
               $buyout->setUser($user);
               $creditCard = $this->creditCardDBDAO->read($result[0]->getCreditCardId());
               $buyout->setCreditCard($creditCard);
               return $buyout;
           }else
               return false;
       }

   }