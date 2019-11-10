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
            include_once(VIEWS_PATH."validate-session.php");
            $this->creditCardDBDAO->Remove($id);
            $this->showBuyoutListDB();
        }
<<<<<<< HEAD

        public function showBuyoutListDB(){
            include_once(VIEWS_PATH."validate-session.php");
            $lista = $this->buyoutDBDAO->readAll();
            //include_once(VIEWS_PATH."buyoutList.php");
        }
=======
        
>>>>>>> 38e8dca1eadb1e38e903155c8e70584d41466f6e
    }
?>