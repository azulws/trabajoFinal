<?php
    namespace Controllers;

    use DAO\CinemaDAO as CinemaDAO;
    use DAO\CinemaDBDAO as CinemaDBDAO;
    use DAO\RoomDBDAO as RoomDBDAO;
    use Models\Cinema as Cinema;

    class cinemaController
    {
        private $cinemaDAO;
        private $cinemaDBDAO;

        public function __construct()
        {
            $this->cinemaDAO = new CinemaDAO();
            $this->cinemaDBDAO = new CinemaDBDAO();
            $this->roomDBDAO = new RoomDBDAO();
        }

        public function ShowAddView()
        {   include_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."cinemaAdd.php");
        }

        public function Add($name, $address, $ticketValue)
        {   
            include_once(VIEWS_PATH."validate-session.php");
            $cinema = new Cinema();
            $cinema->setName($name);
            $cinema->setAddress($address);

            $cinema->setTicketValue($ticketValue);

            $this->cinemaDAO->Add($cinema);

            $this->ShowAddView();
        }

        public function AddDB($name, $address,$ticketValue)
        {
            $cinema = new Cinema();
            $cinema->setName($name);
            $cinema->setAddress($address);
            $cinema->setTicketValue($ticketValue);
            $result=$this->cinemaDBDAO->Add($cinema); 
           
            if($result==null)
            {
                include_once(VIEWS_PATH."errorEnConexionDb");
            }else
             {
                $this->showcinemaListDB();
             }
                 
        }

        public function Remove($name)
        {
            $this->cinemaDAO->Remove($name);

            $this->showcinemaList();
        }

        public function RemoveDB($id)
        {
            $rooms = $this->roomDBDAO->readAllByCinema($id);
            if($rooms!=false){
                $this->showcinemaListDB("El cine tiene registros de salas. No se puede eliminar");
            }else{
                $this->cinemaDBDAO->Remove($id);

                $this->showcinemaListDB("El cine fue eliminado con exito");
            }
        }

        public function showcinemaList(){
            $lista = $this->cinemaDAO->GetAll();
            include_once(VIEWS_PATH."cinemalist.php");
        }

        public function showcinemaListDB($message=""){
            $lista = $this->cinemaDBDAO->readAll();
            if($lista==false){
                $message = "No hay cines cargados en la base de datos";
            }
            include_once(VIEWS_PATH."cinemalist.php");
        }
        public function ShowUpdateCinema($id){
            $cinema=$this->cinemaDBDAO->read($id);
            include_once(VIEWS_PATH."cinemaUpdate.php");
        }
        public function ShowMovieFunctions(){
            //TODO $lista = $this->movieFunctionDBDAO->GetAll();;
           // include_once(VIEWS_PATH."movieList.php");
        }

        public function UpdateDB($name,$address,$ticket_value,$id)
        {
            $cinema = new Cinema();
            $cinema->setName($name);
            $cinema->setAddress($address);
            $cinema->setTicketValue($ticket_value);

            $cinema->setId($id);

            $this->cinemaDBDAO->Update($cinema);

            $this->showcinemaListDB();
        }
    } 
?>