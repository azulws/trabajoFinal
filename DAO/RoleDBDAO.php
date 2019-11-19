<?php 
    namespace Dao;
     
    use DAO\Connection as Connection;
    use DAO\ DAO\QueryType as QueryType;
    use \PDO as PDO;
    use \Exception as Exception;
    use Models\Role as Role;
 
    class RoleDBDAO
    {
        private $connection;

        private $tablename = "roles";

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
           $role = new Role();
           $role->setId($v['role_id']);
           $role->setDescription($v['role_description']);
           array_push($userList,$role);
       }
       if(count($userList)>0)
           return $userList;
       else
           return false;
    }

   public function Add($user){
       // Guardo como string la consulta sql utilizando como value, marcadores de parámetros con name (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada 

       $sql = "INSERT INTO $this->tablename (role_id, role_description) 
       VALUES (:role_id, :role_description)";

       $parameters['role_id'] = $user->getId();
       $parameters['role_description'] = $user->getDescription();
       

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
       $sql = "DELETE FROM $this->tablename WHERE role_id = :role_id";
       $parameters['role_id'] = $id;
       
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
       if($user->getRole()->getId()==2){
           $sql = "UPDATE $this->tablename SET role_id = 1 WHERE user_id = :user_id";
           
       }else{
           $sql = "UPDATE $this->tablename SET role_id = 2 WHERE user_id = :user_id";
       }
       $parameters['role_id'] = $id;
       try{
           $this->connection = Connection::getInstance();
           return $this->connection->ExecuteNonQuery($sql, $parameters);
       }
       catch(PDOException $e){
           echo $e;
       }
   }

   public function read ($role_id)
   {
       $sql = "SELECT * FROM $this->tablename  where role_id = :role_id";
       $parameters['role_id'] = $role_id;
       try
       {
           $this->connection = Connection::getInstance();
           $resultSet = $this->connection->execute($sql, $parameters);
           if(!empty($resultSet))
           {
               $result = $this->mapear($resultSet);
               $role = new Role();
               $role->setId($result[0]->getId());
               $role->setDescription($result[0]->getDescription());
               return $role;
           }else
               return false;
       }
       catch(PDOException $e)
       {
           echo $e;
       }
      
   }

}