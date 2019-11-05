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
        {   include_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."cinemaAdd.php");
        }

        public function Add($name, $address, $capacity, $ticketValue)
        {   
            include_once(VIEWS_PATH."validate-session.php");
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

        public function Remove($id) //TODO cambiar a $cinema
        {
            include_once(VIEWS_PATH."validate-session.php");
            $this->cinemaDAO->Remove($id);
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
            include_once(VIEWS_PATH."validate-session.php");
            $lista = $this->cinemaDBDAO->readAll();
            include_once(VIEWS_PATH."cinemalist.php");
        }
        public function ShowUpdateCinema($id)
        {
            include_once(VIEWS_PATH."validate-session.php");
            $cinema=$this->cinemaDBDAO->read($id);
            include_once(VIEWS_PATH."cinemaUpdate.php");
        }
        public function ShowMovieFunctions()
        {
              include_once(VIEWS_PATH."validate-session.php");
            //TODO $lista = $this->movieFunctionDBDAO->GetAll();;
           // include_once(VIEWS_PATH."movieList.php");
        }

        public function UpdateDB($name,$ticket_value,$capacity)
        {
            include_once(VIEWS_PATH."validate-session.php");
            $this->cinemaDBDAO->Update($name,$ticket_value,$capacity);
            $this->showcinemaListDB();
        }
    } 
?>