<?php
foreach($_SESSION["listaMovies"] as $item){
    echo '<div class="intento">'.
         '<p class="tituloMovie">'.$item->getTitulo().'</p>'.
         '<img src="https://image.tmdb.org/t/p/w500'.$item->getPoster().'">'.
         '<p> Estreno: '.$item->getFechaEstreno().'</p>'.
         '<p> Puntuacion: '.$item->getPuntuacion().'</p>'.
         '<p> Descripcion: '.$item->getDescripcion().'</p>'.
         '</div>';
}
?>