<?php
    namespace Controllers;

    use DAO\CineDAO as CineDAO;
    use Models\Cine as Cine;

    class CineController
    {
        private $cineDAO;

        public function __construct()
        {
            $this->cineDAO = new CineDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."altaCine.php");
        }

        public function Add($nombre, $direccion, $capacidad, $valorEntrada)
        {
            $cine = new Cine();
            $cine->setNombre($nombre);
            $cine->setDireccion($direccion);
            $cine->setCapacidad($capacidad);
            $cine->setValorEntrada($valorEntrada);

            $this->cineDAO->Add($cine);

            $this->ShowAddView();
        }

        public function Remove($nombre)
        {
            $this->cineDAO->Remove($nombre);

            $this->listarCines();
        }

        public function listarCines(){
            $lista = $this->cineDAO->GetAll();
            include_once(VIEWS_PATH."listaCine.php");
        }
    } 
?>