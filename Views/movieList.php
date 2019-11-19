<?php
     include_once(VIEWS_PATH."login.php");
?>
    <div class ="container">
    <?php if($genres!=false){?>
    <form class="genre" method = "POST" action = <?php echo FRONT_ROOT."MovieFunction/listMovieFunctionListByGenreDB"?>>
    <h3> GENERO </h3>
     <select class="select-genre" name = "genreId">;
         <?php foreach($genres as $genre){
               echo '<option class="select-option-genre" value = '.$genre->getId().'> '.$genre->getDescription().' </option>';
          } ?>
     </select>
     <button class="select-genre-button" type = "submit"> Buscar </button>
     </form>
    <?php } ?>
    
    <div class="row">
    <?php if($lista!=false) {foreach($lista as $item){ 
     echo '<div class="col-lg-4 col-md-6 mb-4 showMovies">
          <div class="card h-100" >
          <img class="rounded float-center"
               srcset="https://image.tmdb.org/t/p/w500'.$item->getPoster().', 300w"
               sizes="(max-width: 10px) 50px" 
               src="https://image.tmdb.org/t/p/w500'.$item->getPoster().'" alt="..." height="350">
          <div class=card-body">
          <h4 class="card-title"> 
          <form method = "POST" action = '.FRONT_ROOT.'MovieFunction/showFunctionsByMovie>    
          <input type="hidden" name = "movieId" value = '.$item->getId().'>
          <button class="title-button" type = "submit">'.$item->getTitle().'</button> </form>
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
    echo "</div>";
    echo "<div class='movieList-empty'><h2>No hay funciones cargadas en cartelera</h2></div>";
}
