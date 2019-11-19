<?php 
    namespace Controllers;

    use Models\CreditCard as CreditCard;
    use DAO\UserDBDAO as UserDBDAO;
    use DAO\CreditCardDBDAO as CreditCardDBDAO;
    use DAO\BuyoutDBDAO as BuyoutDBDAO;

    class CreditCardController
    {
        private $creditCardDBDAO;
        private $buyoutDBDAO;

        public function __construct()
        {
            $this->creditCardDBDAO = new CreditCardDBDAO();
            $this->userDBDAO = new UserDBDAO();
            $this->buyoutDBDAO = new BuyoutDBDAO();
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
            $number= $number1.$number2.$number3;
            if($this->creditCardDBDAO->read($number)==false){
                $creditCard = new CreditCard();
            
                $creditCard->setNumber($number);
                $creditCard->setDescription($description);
                $u = $this->userDBDAO->read($user);
                $creditCard->setUser($u);
                $creditCard->setSecurityCode($securityCode);
                $creditCard->setExpirationDate($expirationDate);
    
                $this->creditCardDBDAO->Add($creditCard);
                $this->showCreditCardList();
            }else{
                $this->showCreditCardList("El número de tarjeta ingresado ya fue registrado");
            }

        }

        public function removeDB($id)
        {
            if($this->buyoutDBDAO->existsByCreditCard($id) == true){
                $this->showCreditCardList("No se puede eliminar la tarjeta ya que se registraron pagos con la misma");
            }else{
                $this->creditCardDBDAO->Remove($id);

                $this->showCreditCardList("La tarjeta se eliminó con éxito");
            }
            

        }
        
        public function exists($number){
            if($this->creditCardDBDAO->read($number)!=false){
                return true;
            }
            return false;
        }

    }
?>