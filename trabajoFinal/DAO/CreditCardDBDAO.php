<?php
    namespace DAO;

    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\CreditCard as CreditCard;
    //use Models\User as User;
    //use DAO\UserDBDAO as User;

    class CreditCardDBDAO{
        {
         
        private $connection;

        public function __construct()
        {
            $this->connection = null;
        }

        public function readAll(){
        $sql = "SELECT * FROM creditCards ORDER BY creditCard_id";
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
   
           
           $creditCardList = array();
           foreach($value as $v){
               $creditCard = new CreditCard();
               $creditCard->setId($v['creditCard_id']);
               $creditCard->setCreditCardDescription($v['creditCard_description']);
               $creditCard->setUser($user);
               array_push($creditCardList,$creditCard);
           }
           if(count($creditCardList)>0)
               return $creditCardList;
           else
               return false;
        }
   
       public function Add($creditCard){
   
           $sql = "INSERT INTO creditCards (creditCard_description,user_id) VALUES (:creditCard_description,:user_id)";
   
           $parameters['creditCard_description'] = $creditCard->getCreditCardDescription();
           $parameters['user_id'] = $creditCard->getUser();
   
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
           $sql = "DELETE FROM creditCards WHERE creditCard_id = :id";
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
           $sql = "SELECT * FROM creditCards where creditCards_id = :id";
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
               $creditCard = new CreditCard();
               $creditCard->setCreditCardDescription($result[0]->getCreditCardDescription());
               $creditCard->setUser($result[0]->getUser());
               return $creditCard;
           }else
               return false;
       }

   }