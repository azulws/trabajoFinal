<?php
    namespace DAO;
    use DAO\Connection;
    use \PDO as PDO;
    use \Exception as Exception;
    use DAO\QueryType as QueryType;
    use Models\User as User;

    class userDBDAO
    {
         
         private $connection;

         public function __construct()
         {
            $this->connection = null;
         }

         
      public function readAll(){
        $sql = "SELECT * FROM users";
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

        
        $userList = array();
        foreach($value as $v){
            $user = new User();
            $user->setEmail($v['email']);
            $user->setPassword($v['pass']);
            $user->setName($v['userName']);
            $user->setLastName($v['last_name']);
            $user->setDni($v['dni']);
            $user->setRol($v['role_id']);
            array_push($userList,$user);
        }
        if(count($userList)>0)
            return $userList;
        else
            return false;
     }

    public function Add($user){
        // Guardo como string la consulta sql utilizando como value, marcadores de parámetros con name (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada 

        $sql = "INSERT INTO users (email,pass,userName,last_name,dni,role_id) 
        VALUES (:email,:pass,:userName,:last_name,:dni,:role_id)";

        $parameters['email'] = $user->getEmail();
        $parameters['pass'] = $user->getPassword();
        $parameters['userName'] = $user->getName();
        $parameters['last_name'] = $user->getLastName();
        $parameters['dni'] = $user->getDni();
        $parameters['role_id'] = $user->getRole();

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

    public function Remove($email){
        $sql = "DELETE FROM users WHERE email = :email";
        $parameters['email'] = $email;
        
        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    
    public function UpdateRole($email){
        $user=$this->read($email);
        if($user->getRole()==2){
            $sql = "UPDATE users SET role_id = 1 WHERE email = :email";
            
        }else{
            $sql = "UPDATE users SET role_id = 2 WHERE email = :email";
        }
        $parameters['email'] = $email;
        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $e){
            echo $e;
        }
    }

    public function read ($email)
    {
        $sql = "SELECT * FROM users where email = :email";
        $parameters['email'] = $email;
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
            $user = new User();
            $user->setEmail($result[0]->getEmail());
            $user->setPassword($result[0]->getPassword());
            $user->setName($result[0]->getName());
            $user->setLastName($result[0]->getLastName());
            $user->setDni($result[0]->getDni());
            $user->setRol($result[0]->getRole());
            return $user;
        }else
            return false;
    }

}
