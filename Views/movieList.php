<?php
foreach($_SESSION["movieList"] as $item){
    echo '<div class="intento">'.
         '<p class="titleMovie">'.$item->getTitle().'</p>'.
         '<img src="https://image.tmdb.org/t/p/w500'.$item->getPoster().'">'.
         '<p> Estreno: '.$item->getReleaseDate().'</p>'.
         '<p> Points: '.$item->getPoints().'</p>'.
         '<p> Description: '.$item->getDescription().'</p>'.
         '</div>';
}
?>