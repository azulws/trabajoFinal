<?php
    namespace DAO;

    use DAO\ICine as ICine;
    use Models\Cine as Cine;

    class CineDAO implements ICine
    {
        private $cineList = array();
        private $fileName = ROOT."Data/cines.json";

        private function RetrieveData()
        {
             $this->cineList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);
                
                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                     $cine = new Cine();
                     $cine->setNombre($content["nombre"]);
                     $cine->setDireccion($content["direccion"]);
                     $cine->setCapacidad($content["capacidad"]);
                     $cine->setValorEntrada($content["valorEntrada"]);
                     array_push($this->cineList, $cine);
                 }
             }
        }


        public function Add($cine){
            $this->RetrieveData();

            $existe = false;
            foreach($this->cineList as $aux){
                if($aux->getNombre()===$cine->getNombre()){
                    $existe = true;
                    break;
                }
            }
            if(!$existe){
                array_push($this->cineList, $cine);
                echo "<script type='text/javascript'>alert('Cine agregado con éxito!');</script>";
            }else{
                echo "<script type='text/javascript'>alert('Cine ya existente');</script>";
            }
            $this->SaveData();
        }

        public function traerCine($nombre){
            $this->RetrieveData();
            foreach($this->cineList as $cine){
                if($nombre===$cine->getNombre()){
                    return $cine;
                }
            }
            return null;
        }


        public function GetAll()
        {
            $this->RetrieveData();

            return $this->cineList;
        }

        public function Remove($nombre)
        {            
            $this->RetrieveData();
            

            $this->cineList = array_filter($this->cineList, function($cine) use($nombre){                
                return $cine->getNombre() != $nombre;
            });
            
            $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cineList as $cine)
            {
                $valuesArray = array();
                $valuesArray["nombre"] = $cine->getNombre();
                $valuesArray["direccion"] = $cine->getDireccion();
                $valuesArray["capacidad"] = $cine->getCapacidad();
                $valuesArray["valorEntrada"] = $cine->getValorEntrada();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }
    }
?>