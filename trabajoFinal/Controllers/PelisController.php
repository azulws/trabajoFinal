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
        foreach($lista as $item){
            echo '<div class="intento">'.
                    '<p class="tituloPelicula">'.$item->getTitulo().'</p>'.
                    '<img src="https://image.tmdb.org/t/p/w500'.$item->getPoster().'">'.
                    '<p> Estreno: '.$item->getFechaEstreno().'</p>'.
                    '<p> Puntuacion: '.$item->getPuntuacion().'</p>'.
                    '<p> Descripcion: '.$item->getDescripcion().'</p>'.
                '</div>';
        }
        echo '<form action='.FRONT_ROOT.'Pelis/turnPage>
        <button type="submit">Pasar Pagina</button>
    </form>';
    echo '<form action="'.FRONT_ROOT.'Login/homeUser">
            <button>Volver</button></form>';
        //include_once(VIEWS_PATH.'listaPeliculas.php');
    }
    public function nextPage(){
        $pageNumber++;
        $lista = $this->pelisList->getPeliculas($pageNumber);

        foreach($lista as $item){
            echo '<div class="intento">'.
                    '<p class="tituloPelicula">'.$item->getTitulo().'</p>'.
                    '<img src="https://image.tmdb.org/t/p/w500'.$item->getPoster().'">'.
                    '<p> Estreno: '.$item->getFechaEstreno().'</p>'.
                    '<p> Puntuacion: '.$item->getPuntuacion().'</p>'.
                    '<p> Descripcion: '.$item->getDescripcion().'</p>'.
                '</div>';
        }
        echo '<form action='.FRONT_ROOT.'Pelis/listarPelis>
        <button type="submit">Pagina anterior</button>
    </form>';
    echo '<form action="'.FRONT_ROOT.'Login/homeUser">
            <button>Volver</button></form>';
        //include_once(VIEWS_PATH.'listaPeliculas.php');
    }
    
}
