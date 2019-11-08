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
         private $tablename = "users";

         public function __construct()
         {
            $this->connection = null;
         }

         
      public function readAll(){
        $sql = "SELECT * FROM $this->tablename" ;
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

        
        $userList = array();
        foreach($value as $v){
            $user = new User();
            $user->setEmail($v['email']);
            $user->setPassword($v['pass']);
            $user->setName($v['userName']);
            $user->setLastName($v['last_name']);
            $user->setDni($v['dni']);
            $user->setRole($v['role_id']);
            array_push($userList,$user);
        }
        if(count($userList)>0)
            return $userList;
        else
            return false;
     }

    public function Add( User $user){
        // Guardo como string la consulta sql utilizando como value, marcadores de parámetros con name (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada 

        $sql = "INSERT INTO $this->tablename (email,pass,userName,last_name,dni,role_id) 
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

    public function Remove($id){
        $sql = "DELETE FROM $this->tablename WHERE user_id = :user_id";
        $parameters['email'] = $id;
        
        try{
            $this->connection = Connection::getInstance();
            return $this->connection->ExecuteNonQuery($sql, $parameters);
        }
        catch(PDOException $e){
            echo $e;
        }
    }
    
    public function UpdateRole($id){
        $user=$this->read($id);
        if($user->getRole()==2){
            $sql = "UPDATE $this->tablename SET role_id = 1 WHERE user_id = :user_id";
            
        }else{
            $sql = "UPDATE $this->tablename SET role_id = 2 WHERE user_id = :user_id";
        }
        $parameters['email'] = $id;
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
        $sql = "SELECT * FROM $this->tablename  where email = :email";
        $parameters['email'] = $email;
        try
        {
            $this->connection = Connection::getInstance();
            $resultSet = $this->connection->execute($sql, $parameters);
            if(!empty($resultSet))
            {
                $result = $this->mapear($resultSet);
                $user = new User();
                $user->setEmail($result[0]->getEmail());
                $user->setPassword($result[0]->getPassword());
                $user->setName($result[0]->getName());
                $user->setLastName($result[0]->getLastName());
                $user->setDni($result[0]->getDni());
                $user->setRole($result[0]->getRole());
                return $user;
            }else
                return false;
        }
        catch(PDOException $e)
        {
            echo $e;
        }
       
    }

}
