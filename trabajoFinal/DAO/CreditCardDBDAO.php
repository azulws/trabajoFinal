<?php
    namespace DAO;

    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\CreditCard as CreditCard;
    use Models\User as User;
    use DAO\UserDBDAO as User;

    class CreditCardDBDAO{
        {
         
        private $connection;
        private $userDBDAO;

        public function __construct()
        {
            $this->connection = null;
            $this->userDBDAO = new UserDBDAO();
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
               $creditCard->setNumber($v['numberCard']);
               $creditCard->setDescription($v['creditCard_description']);
               $user = $this->userDBDAO->read($v['user_email']);
               $creditCard->setUser($user);
               $creditCard->setSecurityCode($v['security_code']);
               $creditCard->setExpirationDate($v['expiration_date']);
               array_push($creditCardList,$creditCard);
           }
           if(count($creditCardList)>0)
               return $creditCardList;
           else
               return false;
        }
   
       public function Add($creditCard){
   
            $sql = "INSERT INTO creditCards (numberCard,creditCard_description,user_email,security_code,expiration_date)
                VALUES (:numberCard,:creditCard_description,:user_email,:security_code,expiration_date)";
    
            $parameters['numberCard'] = $creditCard->getNumber();
            $parameters['creditCard_description'] = $creditCard->getDescription();
            $parameters['user_email'] = $creditCard->getUser()->getEmail();
            $parameters['security_code'] = $creditCard->getSegurityCode();
            $parameters['expiration_date'] = $creditCard->getExpirationDate();
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
               $creditCard->setNumber($result[0]->getNumber());
               $creditCard->setDescription($result[0]->getDescription());
               $user = $this->userDBDAO->read($result[0]->getEmail());
               $creditCard->setUser($user);
               $creditCard->setSecurityCode($result[0]->getSecurityCode());
               $creditCard->setExpirationDate($result[0]->getExpirationDate());
               return $creditCard;
           }else
               return false;
       }

   }