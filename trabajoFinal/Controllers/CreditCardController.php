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

        public function showViewAdd($message=""){
            require_once(VIEWS_PATH."creditCardAdd.php");
        }

        public function showCreditCardList($message=""){
            require_once(VIEWS_PATH."creditCardList.php");
        }
        public function add($number, $description, $user, $segurityCode, $expirationDate)
        {
            $creditCard = new CreditCard();
            $creditCard->setNumber($number);
            $creditCard->setDescription($description);
            $u = $this->userDBDAO->read($user);
            $creditCard->setUser($u);
            $creditCard->setSecurityCode($segurityCode);
            $creditCard->setExpirationDate($expirationDate);

            $this->creditCardDBDAO->Add($creditCard);
        }

        public function removeDB($id)
        {
            $this->creditCardDBDAO->Remove($id);

            $this->showCreditCardListDB();
        }
        

    }
?>