<?php 
    namespace Controllers;

    use Models\Ticket as Ticket;
    use Models\MovieFunction as MovieFunction;
    use DAO\TicketDBDAO as TicketDBDAO;

    class TicketController
    {
        private $ticketDBDAO;

        public function __construct()
        {
            $this->ticketDBDAO = new TicketDBDAO();
        }

        public function ShowTicketView()
        {
            //require_once(VIEWS_PATH."ticketDetails.php");
        }

        /*public function AddDB($qr, $movieFunction)
        {
            $ticket = new Ticket();
            $ticket->setQr($qr);
            $ticket->setMovieFunction($movieFunction);
            
            $this->ticketDBDAO->Add($ticket;

            $this->ShowTicketView();
        }*/

        public function RemoveDB($id)
        {
            include_once(VIEWS_PATH."validate-session.php");
            $this->ticketDBDAO->Remove($id);
            $this->showTicketListByUserDB();
        }

        public function showTicketListByUserDB()
        {
            include_once(VIEWS_PATH."validate-session.php");
            $lista = $this->ticketDBDAO->readAll();
            //include_once(VIEWS_PATH."ticketListByUser.php");
        }
    }
?>