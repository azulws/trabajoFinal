<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
   <<ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <?php for ($i=1; $i < count($lista) ; $i++) { 
            echo  '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"></li>';
        }?>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src= <?php echo 'https://image.tmdb.org/t/p/w500'.$lista[0]->getPoster(); ?> alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>My Caption Title (1st Image)</h5>
                <p>The whole caption will only show up if the screen is at least medium size.</p>
            </div>
        </div>
        <?php
        foreach($lista as $item){
            if($lista[0]!=$item){
                echo '<div class="carousel-item">';
                echo '<img class="d-block w-100" src='.'https://image.tmdb.org/t/p/w500'.$item->getPoster().' alt="Second slide"> </div>';
            }
    }?>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

<!--<?php/*
if($lista!=false){
    foreach($lista as $item){
    echo '<div class="intento">'.
         '<p class="titleMovie">'.$item->getTitle().'</p>'.
         '<img src="https://image.tmdb.org/t/p/w500'.$item->getPoster().'">'.
         '<p> Estreno: '.$item->getReleaseDate().'</p>'.
         '<p> Points: '.$item->getPoints().'</p>'.
         '<p> Description: '.$item->getDescription().'</p>'.
         '<p> Duracion: '.$item->getRuntime().'</p>'.
         '</div>';
    }
}else{
    echo "<p>NO HAY PELICULAS</p>";
}
*/?>-->