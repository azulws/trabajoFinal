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


        public function Add($movieFunction,$buyout)
        {
            $ticket = new Ticket();
            //Generar qr
            $ticket->setQr("1234asd");
            $ticket->setMovieFunction($movieFunction);
            $ticket->setBuyout($buyout);
            
            $this->ticketDBDAO->Add($ticket);
        }

        public function RemoveDB($id)
        {
            $this->ticketDBDAO->Remove($id);

            $this->showTicketListByUserDB();
        }

        public function showTicketListByUser(){
            $ticketsUser = $this->ticketDBDAO->readAllByUser($_SESSION['logged']);
            include_once(VIEWS_PATH."ticketListByUser.php");
        }

        public function showSales($movieFunctionId){
            $ticketList = $this->ticketDBDAO->readAllByMovieFunction($movieFunctionId);
            include_once(VIEWS_PATH."buyoutList.php");
        }
    }
?>