<?php 
    namespace Controllers;
    use DAO\PelisDAO as PelisDAO;
    use Models\Pelicula as Pelicula;

class PelisController{
    private $pelisList;
    private $pageNumber;

    public function __construct(){
            $this->pelisList = new PelisDAO();
        }

    public function listarPelis(){
        $pageNumber = 1;
        $lista = $this->pelisList->getPeliculas($pageNumber);
        include_once(VIEWS_PATH.'listadoPeliculas.php');
        
    public function nextPage(){
        $pageNumber++;
        $lista = $this->pelisList->getPeliculas($pageNumber);
        include_once(VIEWS_PATH.'listadoPeliculas.php');
    }
    
}
