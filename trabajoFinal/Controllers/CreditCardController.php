<?php 
    namespace Controllers;

    use Models\CreditCard as CreditCard;
    use DAO\UserDBDAO as UserDBDAO;

    class CreditCardController
    {
        private $creditCardDBDAO;

        public function __construct()
        {
            $this->creditCardDBDAO = new CreditCardDBDAO();
            $this->userDBDAO = new UserDBDAO();
        }

        /*public function AddDB($description, $user, $segurityCode, $expirationDate)
        {
            $creditCard = new CreditCard();
            $creditCard->setDescription($description);
            $u = $this->userDBDAO->read($user);
            $creditCard->setUser($u);
            $creditCard->setSecurityCode($segurityCode);
            $creditCard->setExpirationDate($expirationDate);
            $this->creditCardDBDAO->Add($creditCard);
        }*/

        public function RemoveDB($id)
        {
            $this->creditCardDBDAO->Remove($id);

            $this->showBuyoutListDB();
        }
        
    }
?>