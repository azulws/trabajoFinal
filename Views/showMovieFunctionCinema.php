<?php
include_once(VIEWS_PATH.'login.php');
if(isset($message) && $message!=""){
  echo '<script type="text/javascript">';
  echo ' alert("'.$message.'")'; 
  echo '</script>';
}
?>
<form method="POST" padding: 2rem !important;" action=<?php echo FRONT_ROOT."MovieFunction/showMovieFunctionListDB";?>>
		<div align="center">
			 <h2>Seleccione cine </h2>
			 <div class="form-register"> 
				<div class="form-register-ul">
			<?php
				if($cinemas!=false){
				echo "<select style='width:128px' name = cinemaId>";
				foreach($cinemas as $cine){
					echo "<option value = ".$cine->getId()."> ".$cine->getName()."</option>";
				}
				echo "</select>";
				echo "<br><br>";
     			echo "<button type='submit'>Ver funciones</button>";
				}else{
					echo "<h2>No se encuentra cargado ningun cine</h2>";
				}?>
				</div>
				</div>
		</div>
</form>

<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>
