<?php
include_once(VIEWS_PATH.'login.php');
if($message!=""){
  echo '<script type="text/javascript">';
  echo ' alert("'.$message.'")'; 
  echo '</script>';
}
?>
<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."MovieFunction/validateFunctionByDate";?>>
		<div align="center">
     		<h2>Alta de funcion </h2>
			<?php
				echo "<select name = cinemaId>";
				foreach($cinemas as $cine){
					echo "<option value = ".$cine->getId()."> ".$cine->getName()."</option>";
				}
				echo "</select>";
				echo "<br>";
				echo "<select name = movieId>";
				foreach($movies as $movie){
					echo "<option value = ".$movie->getMovieId()."> ".$movie->getTitle()."</option>";
				}
				echo "</select>";?>
				<br>
				<input type="date" name="date" min=<?php echo "20".date("y-m-d");?> required><br>
     			<button type="submit">Cargar funcion</button>
    </form>
</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>
