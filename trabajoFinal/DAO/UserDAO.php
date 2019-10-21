<?php
    namespace DAO;

    use DAO\IUser as IUser;
    use Models\Usuario as Usuario;

    class UserDAO implements IUser
    {
        private $userList = array();
        private $fileName = ROOT."Data/users.json";

        private function RetrieveData()
        {
             $this->userList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                     $user = new Usuario();
                     $user->setEmail($content["email"]);
                     $user->setPassword($content["password"]);
                     $user->setNombre($content["nombre"]);
                     $user->setApellido($content["apellido"]);
                     $user->setDni($content["dni"]);
                     $user->setRol($content["rol"]);
                     array_push($this->userList, $user);
                 }
             }
        }

        public function Add($user){
            $this->RetrieveData();     
            if(!in_array($user->getEmail(),$this->userList))
                array_push($this->userList, $user);
            $this->SaveData();
        }

        public function traerUsuario($email){
            $this->RetrieveData();
            foreach($this->userList as $user){
                if($email===$user->getEmail()){
                    return $user;
                }
            }
            return null;
        }


        public function GetAll()
        {
            $this->RetrieveData();

            return $this->userList;
        }

        public function Remove($email)
        {            
            $this->RetrieveData();
            

            $this->userList = array_filter($this->userList, function($user) use($email){                
                return $user->getEmail() != $email;
            });
            
            $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {
                $valuesArray = array();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["nombre"] = $user->getNombre();
                $valuesArray["apellido"] = $user->getApellido();
                $valuesArray["dni"] = $user->getDni();
                $valuesArray["rol"] = $user->getRol();

                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }
    }
?>