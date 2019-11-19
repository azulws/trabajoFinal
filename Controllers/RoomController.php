<?php
    namespace Controllers;

    use DAO\RoomDBDAO as RoomDBDAO;
    use DAO\CinemaDBDAO as CinemaDBDAO;
    use DAO\MovieFunctionDBDAO as MovieFunctionDBDAO;
    use Models\Room as Room;

    class RoomController
    {
        private $roomDBDAO;

        public function __construct()
        {
            $this->roomDBDAO = new RoomDBDAO();
            $this->cinemaDBDAO = new CinemaDBDAO();
            $this->movieFunctionDBDAO = new MovieFunctionDBDAO();
        }

        public function ShowAddView($cinemaId)
        {   include_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."roomAdd.php");
        }


        public function showRoomList($cinemaId,$message = ""){
            $lista = $this->roomDBDAO->readAllByCinema($cinemaId);
            if($lista==false){
                $message = "No hay salas cargadas en este cine";
            }
            //$cineId = $cinemaId;
            include_once(VIEWS_PATH."roomlist.php");
        }

        public function Add($name,$capacity,$cinemaId)
        {
            $room = new Room();
            $room->setName($name);
            $room->setCapacity($capacity);
            $cinema = $this->cinemaDBDAO->read($cinemaId);
            $room->setCinema($cinema);
            if(!$this->roomDBDAO->existsByName($room)){   
                $result=$this->roomDBDAO->Add($room); 
                $this->showRoomList($cinemaId,"Se añadió la sala correctamente");
            }else{
                $this->showRoomList($cinemaId,"El nombre de la sala ya existe en este cine");
            }               
        }

        public function Remove($id,$cinemaId)
        {
            
            $response = $this->movieFunctionDBDAO->functionsExistsInRoom($id);
            
            if($response !=false){
                $this->showRoomList($cinemaId,"No se puede eliminar la sala porque tiene funciones cargadas");

            }else{
                $this->roomDBDAO->Remove($id);

                $this->showRoomList($cinemaId,"La sala fue eliminada con exito");
            }
            
        }

        public function ShowUpdateRoom($id){
            $room = $this->roomDBDAO->read($id);
            include_once(VIEWS_PATH."roomUpdate.php");
        }

        public function Update($name,$capacity,$roomId,$cinemaId)
        {
            $room = new Room();
            $room->setName($name);
            $room->setCapacity($capacity);
            $room->setId($roomId);
            $this->roomDBDAO->Update($room);
            $this->showRoomList($cinemaId,"La sala se actualizó correctamente");
        }
    } 
?>