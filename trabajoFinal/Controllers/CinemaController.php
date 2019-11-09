<?php
    namespace Controllers;

    use DAO\CinemaDAO as cinemaDAO;
    use DAO\CinemaDBDAO as cinemaDBDAO;
    use Models\Cinema as cinema;

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
            include_once(VIEWS_PATH."validate-session.php");
            $cinema = new Cinema();
            $cinema->setName($name);
            $cinema->setAddress($address);
            $cinema->setCapacity($capacity);
            $cinema->setTicketValue($ticketValue);

            $this->cinemaDBDAO->Add($cinema);

            $this->ShowAddView();
        }

        public function Remove($name)
        {
            include_once(VIEWS_PATH."validate-session.php");
            $this->cinemaDAO->Remove($name);
            $this->showcinemaList();
        }

        public function RemoveDB($id)
        {
            include_once(VIEWS_PATH."validate-session.php");
            $this->cinemaDBDAO->Remove($id);
            $this->showcinemaListDB();
        }

        public function showcinemaList()
        {
            include_once(VIEWS_PATH."validate-session.php");
            $lista = $this->cinemaDAO->GetAll();
            include_once(VIEWS_PATH."cinemalist.php");
        }

        public function showcinemaListDB()
        {
            $lista = $this->cinemaDBDAO->readAll();
            include_once(VIEWS_PATH."cinemalist.php");
        }


        public function ShowUpdateCinema($id)
        {
            include_once(VIEWS_PATH."validate-session.php");
            $cinema=$this->cinemaDBDAO->readById($id);
            include_once(VIEWS_PATH."cinemaUpdate.php");
        }

        public function ShowMovieFunctions(){
            include_once(VIEWS_PATH."validate-session.php");
            //TODO $lista = $this->movieFunctionDBDAO->GetAll();;
            include_once(VIEWS_PATH."movieFuctionList.php");
        }

        public function UpdateDB($name,$address,$ticket_value,$capacity,$id)
        {
            include_once(VIEWS_PATH."validate-session.php");
            $cinema = new Cinema();
            $cinema->setName($name);
            $cinema->setAddress($address);
            $cinema->setTicketValue($ticket_value);
            $cinema->setCapacity($capacity);
            $cinema->setId($id);

            $this->cinemaDBDAO->Update($cinema);

            $this->showcinemaListDB();
        }
    } 
?>