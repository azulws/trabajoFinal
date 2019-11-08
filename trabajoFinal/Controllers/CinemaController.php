<?php
    namespace Controllers;

    use DAO\CinemaDAO as cinemaDAO;
    use DAO\CinemaDBDAO as cinemaDBDAO;
    use Models\Cinema as Cinema;

    class cinemaController
    {
        private $cinemaDAO;
        private $cinemaDBDAO;

        public function __construct()
        {
            $this->cinemaDAO = new CinemaDAO();
            $this->cinemaDBDAO = new CinemaDBDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."cinemaAdd.php");
        }

        public function Add($name, $address, $capacity, $ticketValue)
        {
            $cinema = new Cinema();
            $cinema->setName($name);
            $cinema->setAddress($address);
            $cinema->setCapacity($capacity);
            $cinema->setTicketValue($ticketValue);

            $this->cinemaDAO->Add($cinema);

            $this->ShowAddView();
        }

        public function AddDB($name, $address, $capacity, $ticketValue)
        {
            $cinema = new Cinema();
            $cinema->setName($name);
            $cinema->setAddress($address);
            $cinema->setCapacity($capacity);
            $cinema->setTicketValue($ticketValue);

            $this->cinemaDBDAO->Add($cinema);

            $this->ShowAddView();
        }

        public function Remove($id) //TODO cambiar a $cinema
        {
            $this->cinemaDAO->Remove($id);

            $this->showcinemaList();
        }

        public function RemoveDB($id)
        {
            $this->cinemaDBDAO->Remove($id);

            $this->showcinemaListDB();
        }

        public function showcinemaList(){
            $lista = $this->cinemaDAO->GetAll();
            include_once(VIEWS_PATH."cinemalist.php");
        }

        public function showcinemaListDB(){
            $lista = $this->cinemaDBDAO->readAll();
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

        public function UpdateDB($name,$ticket_value,$capacity)
        {
            $this->cinemaDBDAO->Update($name,$ticket_value,$capacity);

            $this->showcinemaListDB();
        }
    } 
?>