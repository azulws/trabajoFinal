<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."MovieFunction/listMovieFunctionListByGenreDB";?>>
    <div align="center">
        <h2>Buscar por Genero </h2>
        <?php
            echo "<select name = genreId>";
            foreach($genres as $genre){
                echo "<option value = ".$genre->getId()."> ".$genre->getDescription()."</option>";
            }
            echo "</select>";
            echo "<br><br>";?>
            <button type="submit">Seleccionar Genero</button>
    </div>
</form>