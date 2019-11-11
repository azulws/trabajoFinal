<?php 
    namespace Controllers;

    use Models\Buyout as Buyout;
    use Models\Ticket as Ticket;
    use DAO\BuyoutDBDAO as BuyoutDBDAO;
    use DAO\TicketDBDAO as TicketDBDAO;
    use DAO\CreditCardDBDAO as CreditCardDBDAO;
    use DAO\UserDBDAO as UserDBDAO;
    use DAO\MovieFunctionDBDAO as MovieFunctionDBDAO;
    
    class BuyoutController
    {
        private $buyoutDBDAO;
        private $ticketDBDAO;
        private $userDBDAO;
        private $creditCardDBDAO;
        private $movieFunctionDBDAO;

        public function __construct()
        {
            $this->buyoutDBDAO = new BuyoutDBDAO();
            $this->ticketDBDAO = new TicketDBDAO();
            $this->userDBDAO = new UserDBDAO();
            $this->creditCardDBDAO = new CreditCardDBDAO();
            $this->movieFunctionDBDAO = new MovieFunctionDBDAO();
        }

        public function Add($discount, $total, $cantTicket, $user, $creditCard)
        {
            $buyout = new Buyout();
            $buyout->setDiscount($discount);
            $buyout->setBuyDate(date("Y-m-d H:i:s"));
            $buyout->setTotal($total);
            $buyout->setCantTicket($cantTicket);
            $buyout->setUser($user);
            $buyout->setCreditCard($creditCard);

            $this->buyoutDBDAO->Add($buyout);

        }

        public function RemoveDB($id)
        {
            $this->buyoutDBDAO->Remove($id);
            $this->showBuyoutListDB();
        }

        public function showBuyoutCantTickets($ticketsLeft,$movieFunctionId){
            include_once(VIEWS_PATH."validate-session.php");
            $function = $this->movieFunctionDBDAO->read($movieFunctionId);
            $price = $function->getCinema()->getTicketValue();
            include_once(VIEWS_PATH."buyoutCantTickets.php");
        }

        public function showBuyoutForm($movieFunctionId,$cantTicket){
            include_once(VIEWS_PATH."validate-session.php");
            $creditCards = $this->creditCardDBDAO->readAllByUser($_SESSION['logged']);
            $function = $this->movieFunctionDBDAO->read($movieFunctionId);
            $total = $cantTicket * $function->getCinema()->getTicketValue();
            $discount = $this->discountCalculate($function,$cantTicket,$total);
            include_once(VIEWS_PATH."buyoutForm.php");
        }

        public function discountCalculate($movieFunction,$cantTicket,$total){
            //25 % del total, si es lunes o martes y si compro dos entradas o mas
            $discount = 0;
            if($cantTicket >1){
                $date = strtotime($movieFunction->getStartDateTime());
                if(date("l",$date) == "Tuesday" || date("l",$date) == "Wednesday"){
                    $discount = $total*0.25;
                }
            }
            return $discount;
        }

        public function showBuyoutResume($movieFunctionId,$discount,$total,$cantTickets,$creditCardId){
            $function = $this->movieFunctionDBDAO->read($movieFunctionId);
            $creditCard = $this->creditCardDBDAO->read($creditCardId);
            include_once(VIEWS_PATH.'buyoutResume.php');
        }

        public function countTicketsForm($movieFunctionId){
            $movieFunction=$this->movieFunctionDBDAO->read($movieFunctionId);
            $ticketsLeft= $this->ticketsLeft($movieFunction);
            $this->showBuyoutCantTickets($ticketsLeft,$movieFunctionId);
        }
        public function ticketsLeft($movieFunction){
            $cant = $this->ticketDBDAO->countTicketsForFunction($movieFunction);
            $capacity=$movieFunction->getCinema()->getCapacity();
            return $capacity-$cant;
        }

        public function submit($discount,$total,$cantTicket,$creditCardNumber,$movieFunctionId){
            $creditCard = $this->creditCardDBDAO->read($creditCardNumber);
            $this->Add($discount, $total, $cantTicket, $_SESSION['logged'], $creditCard);
            $response = $this->buyoutDBDAO->readLast();
            $cantTicket = $response->getCantTicket();
            $movieFunction = $this->movieFunctionDBDAO->read($movieFunctionId);
            
            for($i = 0; $i<$cantTicket; $i++){
                $ticket = new Ticket();
                $ticket->setQr("temp");
                $ticket->setMovieFunction($movieFunction);
                $ticket->setBuyout($response);
                $this->ticketDBDAO->Add($ticket);
                $ticket=$this->ticketDBDAO->ReadLast();
                $ticket->setQr("'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=".$response->getId()."-".$ticket->getId()."-".$_SESSION['logged']->getEmail()."&choe=UTF-8'");
                $this->ticketDBDAO->Update($ticket);
            }
            $this->showNavUser("La compra fue exitosa!");
        }

        public function showNavUser($message = ""){
            include_once(VIEWS_PATH.'navUser.php');
        }
    }
?>