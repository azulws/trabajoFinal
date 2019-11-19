<?php
include_once(VIEWS_PATH.'login.php');
if(isset($message) && $message!=""){
  echo '<script type="text/javascript">';
  echo ' alert("'.$message.'")'; 
  echo '</script>';
}?>
<form method="POST" padding: 2rem !important;" action=<?php echo FRONT_ROOT."MovieFunction/validateFunctionByDate";?>>
		<div align="center">
			 <h2>Alta de funcion </h2>
			 <div class="form-register"> 
				 <div class="form-register-ul">
			<?php
				echo "<select style='width:175px' name = roomId>";
				foreach($rooms as $room){
					echo "<option value = ".$room->getId()."> ".$room->getName()."</option>";
				}
				echo "</select>";
				echo "<br>";
				echo "<select style='width:175px' name = movieId>";
				foreach($movies as $movie){
					echo "<option value = ".$movie->getId()."> ".$movie->getTitle()."</option>";
				}
				echo "</select>";?>
				<br>
				<input type="date" name="date" min=<?php echo "20".date("y-m-d");?> required><br><br>
     			<button type="submit">Cargar funcion</button>
	</form>
			</div>
			</div>
</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>
