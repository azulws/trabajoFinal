<?php
foreach($_SESSION["listaPeliculas"] as $item){
    echo '<div class="intento">'.
         '<p class="tituloPelicula">'.$item->getTitulo().'</p>'.
         '<img src="https://image.tmdb.org/t/p/w500'.$item->getPoster().'">'.
         '<p> Estreno: '.$item->getFechaEstreno().'</p>'.
         '<p> Puntuacion: '.$item->getPuntuacion().'</p>'.
         '<p> Descripcion: '.$item->getDescripcion().'</p>'.
         '</div>';
}
?>