<?php 
    namespace Controllers;

    use Models\CreditCard as CreditCard;
    use Models\User as User;
    use DAO\BuyoutDBDAO as BuyoutDBDAO;

    class CreditCardController
    {
        private $creditCardDBDAO;

        public function __construct()
        {
            $this->creditCardDBDAO = new CreditCardDBDAO();
        }

        public function ShowCreditCardView()
        {
            //require_once(VIEWS_PATH."creditCard.php");
        }

        /*public function AddDB($creditCardDescription, $user)
        {
            $creditCard = new CreditCard();
            $creditCard->setCreditCardDescription($creditCardDescription);
            $creditCard->setUser($user);
            
            $this->creditCardDBDAO->Add($creditCard);

            $this->ShowCreditCardView();
        }*/

        public function RemoveDB($id)
        {   
            include_once(VIEWS_PATH."validate-session.php");
            $this->creditCardDBDAO->Remove($id);
            $this->showBuyoutListDB();
        }

        public function showBuyoutListDB(){
            include_once(VIEWS_PATH."validate-session.php");
            $lista = $this->buyoutDBDAO->readAll();
            //include_once(VIEWS_PATH."buyoutList.php");
        }
    }
?>