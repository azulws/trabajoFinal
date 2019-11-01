<?php
    namespace DAO;

    use DAO\ICinema as Icinema;
    use Models\Cinema as cinema;

    class cinemaDAO implements ICinema
    {
        private $cinemaList = array();
        private $fileName = ROOT."Data/cinemas.json";

        private function RetrieveData()
        {
             $this->cinemaList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);
                
                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                     $cinema = new Cinema();
                     $cinema->setName($content["name"]);
                     $cinema->setAddress($content["address"]);
                     $cinema->setCapacity($content["capacity"]);
                     $cinema->setTicketValue($content["ticketValue"]);
                     array_push($this->cinemaList, $cinema);
                 }
             }
        }


        public function Add($cinema){
            $this->RetrieveData();

            $existe = false;
            foreach($this->cinemaList as $aux){
                if($aux->getName()===$cinema->getName()){
                    $existe = true;
                    break;
                }
            }
            if(!$existe){
                array_push($this->cinemaList, $cinema);
                echo "<script type='text/javascript'>alert('cinema agregado con éxito!');</script>";
            }else{
                echo "<script type='text/javascript'>alert('cinema ya existente');</script>";
            }
            $this->SaveData();
        }

        public function traercinema($name){
            $this->RetrieveData();
            foreach($this->cinemaList as $cinema){
                if($name===$cinema->getName()){
                    return $cinema;
                }
            }
            return null;
        }


        public function GetAll()
        {
            $this->RetrieveData();

            return $this->cinemaList;
        }

        public function Remove($name)
        {            
            $this->RetrieveData();
            

            $this->cinemaList = array_filter($this->cinemaList, function($cinema) use($name){                
                return $cinema->getName() != $name;
            });
            
            $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cinemaList as $cinema)
            {
                $valuesArray = array();
                $valuesArray["name"] = $cinema->getName();
                $valuesArray["address"] = $cinema->getAddress();
                $valuesArray["capacity"] = $cinema->getCapacity();
                $valuesArray["ticketValue"] = $cinema->getTicketValue();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }
    }
?>