<?php 
    namespace Controllers;

    use Models\Buyout as Buyout;
    use Models\MovieFunction as MovieFunction;
    use DAO\BuyoutDBDAO as BuyoutDBDAO;

    class BuyoutController
    {
        private $buyoutDBDAO;

        public function __construct()
        {
            $this->buyoutDBDAO = new BuyoutDBDAO();
        }

        public function ShowBuyoutView()
        {
            //require_once(VIEWS_PATH."buyoutAdd.php");
        }

        /*public function AddDB($discount, $buy_date, $total, $ticket, $user, $creditCard)
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
            $this->buyoutDBDAO->Remove($id);

            $this->showBuyoutListDB();
        }

        public function showBuyoutListDB(){
            $lista = $this->buyoutDBDAO->readAll();
            //include_once(VIEWS_PATH."buyoutList.php");
        }
    }
?>