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
                     $cinema->setNombre($content["nombre"]);
                     $cinema->setDireccion($content["direccion"]);
                     $cinema->setCapacidad($content["capacidad"]);
                     $cinema->setValorEntrada($content["valorEntrada"]);
                     array_push($this->cinemaList, $cinema);
                 }
             }
        }


        public function Add($cinema){
            $this->RetrieveData();

            $existe = false;
            foreach($this->cinemaList as $aux){
                if($aux->getNombre()===$cinema->getNombre()){
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

        public function traercinema($nombre){
            $this->RetrieveData();
            foreach($this->cinemaList as $cinema){
                if($nombre===$cinema->getNombre()){
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

        public function Remove($nombre)
        {            
            $this->RetrieveData();
            

            $this->cinemaList = array_filter($this->cinemaList, function($cinema) use($nombre){                
                return $cinema->getNombre() != $nombre;
            });
            
            $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cinemaList as $cinema)
            {
                $valuesArray = array();
                $valuesArray["nombre"] = $cinema->getNombre();
                $valuesArray["direccion"] = $cinema->getDireccion();
                $valuesArray["capacidad"] = $cinema->getCapacidad();
                $valuesArray["valorEntrada"] = $cinema->getValorEntrada();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }
    }
?>