<?php 
    namespace Controllers;

    use Models\CreditCard as CreditCard;
    use DAO\UserDBDAO as UserDBDAO;
    use DAO\CreditCardDBDAO as CreditCardDBDAO;

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
            $tarjetas = $this->creditCardDBDAO->readAllByUser($_SESSION["logged"]);
            require_once(VIEWS_PATH."creditCardList.php");
        }
        public function add($description, $user, $number1, $number2, $number3, $securityCode, $expirationDate)
        {
            $creditCard = new CreditCard();
            $number= $number1.$number2.$number3;
            $creditCard->setNumber($number);
            $creditCard->setDescription($description);
            $u = $this->userDBDAO->read($user);
            $creditCard->setUser($u);
            $creditCard->setSecurityCode($securityCode);
            $creditCard->setExpirationDate($expirationDate);

            $this->creditCardDBDAO->Add($creditCard);
            $this->showCreditCardList();
        }

        public function removeDB($id)
        {
            $this->creditCardDBDAO->Remove($id);

            $this->showCreditCardList();
        }
        
        public function exists($number){
            if($this->creditCardDBDAO->read($number)!=false){
                return true;
            }
            return false;
        }

    }
?>