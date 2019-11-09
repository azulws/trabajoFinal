<?php

 if($lista!=false){
    echo'<div class ="container" >
    <div class="row">';
    foreach($lista as $item){
     echo '<div class="col-lg-4 col-md-6 mb-4" id="showMovies">
           <div class="card h-100" >
           <img class="rounded float-center"
                srcset="https://image.tmdb.org/t/p/w500'.$item->getPoster().', 300w"
                sizes="(max-width: 10px) 50px" 
                src="https://image.tmdb.org/t/p/w500'.$item->getPoster().'" alt="..." height="350">
           <div class=card-body">
           <h4 class="card-title">
           <a href="#">'.$item->getTitle().'</a>
           </h4>
           <h5>'.$item->getReleaseDate().'</h5>
           <p class="card-text">'.$item->getDescription().'</p>
           </div>
           <div class="card-footer">
           <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
           </div>
           </div>
            </div>';
     }
    echo'</div>
         </div>';
}else{
    echo "<p>NO HAY PELICULAS</p>";
}

/*
if($lista!=false){
    $a=0;
    foreach($lista as $item){
    echo '<div class="intento">'.
         '<p class="titleMovie">'.$item->getTitle().'</p>'.
         '<img src="https://image.tmdb.org/t/p/w500'.$item->getPoster().'">'.
         '<p> Estreno: '.$item->getReleaseDate().'</p>'.
         '<p> Points: '.$item->getPoints().'</p>'.
         '<p> Declass= scription: '.$item->getDescription().'</p>'.
         '<p> Duracion: '.$item->getRuntime().'</p>'.
         '<form action="'.FRONT_ROOT.'Buyout/Buy">.
         <button>Comprar</button></form>'.
         '</div>';
     $a++;
    }
}else{
    echo "<p>NO HAY PELICULAS</p>";
}
<<<<<<< HEAD
?> */
=======
?>
>>>>>>> ec762f25b9be0c489475f76d3639b4ca203df7fd
