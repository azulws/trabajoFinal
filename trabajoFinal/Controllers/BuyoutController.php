<?php 
    namespace Controllers;

    use Models\Buyout as Buyout;
    use DAO\BuyoutDBDAO as BuyoutDBDAO;
    use DAO\TicketDBDAO as TicketDBDAO;
    use DAO\CreditCardDBDAO as CreditCardDBDAO;
    use DAO\UserDBDAO as UserDBDAO;
    
    class BuyoutController
    {
        private $buyoutDBDAO;
        private $ticketDBDAO;
        private $userDBDAO;
        private $creditCardDBDAO;

        public function __construct()
        {
            $this->buyoutDBDAO = new BuyoutDBDAO();
            $this->ticketDBDAO = new TicketDBDAO();
            $this->userDBDAO = new UserDBDAO();
            $this->creditCardDBDAO = new CreditCardDBDAO();
        }

        public function ShowBuyoutView()
        {
            //require_once(VIEWS_PATH."buyoutAdd.php");
        }

        /*public function Add($discount, $buy_date, $total, $ticket, $user, $creditCard)
        {
            $buyout = new Buyout();
            $buyout->setDiscount($discount);
            $buyout->setBuy_date($buy_date);
            $buyout->setTotal($total);
            $buyout->setTicket($ticket);
            $buyout->setUser($user);
            $buyout->setCreditCard($creditCard);

            $this->buyoutDBDAO->Add($buyout);

            $this->ShowBuyoutView();
        }*/

        public function RemoveDB($id)
        {
            include_once(VIEWS_PATH."validate-session.php");
            $this->buyoutDBDAO->Remove($id);
            $this->showBuyoutListDB();
        }

        public function showBuyoutListDB()
        {
            include_once(VIEWS_PATH."validate-session.php");
            $lista = $this->buyoutDBDAO->readAll();
            //include_once(VIEWS_PATH."buyoutList.php");
        }
    }
?>