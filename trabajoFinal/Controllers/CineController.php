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

        public function ShowListView()
        {
            $cineList = $this->cineDAO->getAll();
            
            require_once(VIEWS_PATH."listaCine.php");
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

            $this->ShowListView();
        }

        public function listarCines(){
            $lista = $this->cineDAO->GetAll();
            foreach($lista as $item){
                echo '<dl>'.
                        '<dt> Cine: '.$item->getNombre().'<dt>'.
                        '<dd> Direccion: '.$item->getDireccion().'</dd>'.
                        '<dd> Capacidad: '.$item->getCapacidad().'</dd>'.
                        '<dd> Valor de la entrada $'.$item->getValorEntrada().'</dd>'.
                        '<form action="'.FRONT_ROOT.'Cine/Remove">
                        <button name="nombre" value="'.$item->getNombre().'">Eliminar</button></form>'.
                    '</dl>';
            }
            echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
            <button>Volver</button></form>';
        }
    }
?>