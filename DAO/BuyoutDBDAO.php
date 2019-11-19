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

    class BuyoutDBDAO{
         
        private $connection;
        private $userDBDAO;
        private $creditCardDBDAO;
        private $tablename = "buyouts";

        public function __construct()
        {
            $this->connection = null;
            $this->userDBDAO = new UserDBDAO();
            $this->creditCardDBDAO = new CreditCardDBDAO();
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
               $buyout->setDiscount($v['discount']);
               $buyout->setBuyDate($v['buy_date']);
               $buyout->setTotal($v['total']);
               $buyout->setCantTicket($v['cantTicket']);
               $user = $this->userDBDAO->read($v['user_email']);
               $buyout->setUser($user);
               $creditCard = $this->creditCardDBDAO->readById($v['creditCard_id']);
               $buyout->setCreditCard($creditCard);
               array_push($buyoutList,$buyout);
           }
           if(count($buyoutList)>0)
               return $buyoutList;
           else
               return false;
        }
   
       public function Add($buyout){
   
           $sql = "INSERT INTO $this->tablename (discount,buy_date,total,cantTicket,user_email,creditCard_id) 
           VALUES (:discount, :buy_date, :total, :cantTicket, :user_email, :creditCard_id)";
   
           $parameters['discount'] = $buyout->getDiscount();
           $parameters['buy_date'] = $buyout->getBuyDate();
           $parameters['total'] = $buyout->getTotal();
           $parameters['cantTicket'] = $buyout->getCantTicket();
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
                if(!empty($resultSet))
                {
                $result = $this->mapear($resultSet);
                $buyout = new Buyout();
                $buyout->setDiscount($result[0]->getDiscount());
                $buyout->setBuyDate($result[0]->getBuyDate());
                $buyout->setTotal($result[0]->getTotal());
                $buyout->setCantTicket($result[0]->getCantTicket());
                $buyout->setId($result[0]->getId());
                $user = $this->userDBDAO->read($result[0]->getUser()->getEmail());
                $buyout->setUser($user);
                $creditCard = $this->creditCardDBDAO->readById($result[0]->getCreditCard()->getId());
                $buyout->setCreditCard($creditCard);
                return $buyout;
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
           $sql = "SELECT * FROM $this->tablename ORDER BY buyout_id DESC limit 1";
           try
           {
               $this->connection = Connection::getInstance();
               $resultSet = $this->connection->execute($sql);
               if(!empty($resultSet))
               {
                   $result = $this->mapear($resultSet);
                   $buyout = new Buyout();
                   $buyout->setDiscount($result[0]->getDiscount());
                   $buyout->setBuyDate($result[0]->getBuyDate());
                   $buyout->setTotal($result[0]->getTotal());
                   $buyout->setCantTicket($result[0]->getCantTicket());
                   $buyout->setId($result[0]->getId());
                   $user = $this->userDBDAO->read($result[0]->getUser()->getEmail());
                   $buyout->setUser($user);
                   $creditCard = $this->creditCardDBDAO->readById($result[0]->getCreditCard()->getId());
                   $buyout->setCreditCard($creditCard);
                   return $buyout;
               }else
                   return false;
           }
           catch(PDOException $e)
           {
               echo $e;
           }
       }

       public function existsByCreditCard ($id)
       {
           $sql = "SELECT * FROM $this->tablename where creditCard_id = :id";
           $parameters['id'] = $id;
           try
           {
               $this->connection = Connection::getInstance();
               $resultSet = $this->connection->ExecuteNonQuery($sql, $parameters);
               if(isset($resultSet) && $resultSet > 0){
                return true;
            }else{
                return false;
            }
           }
           catch(PDOException $e)
           {
               echo $e;
           }
       }
    }