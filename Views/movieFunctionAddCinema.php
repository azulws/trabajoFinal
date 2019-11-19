<?php
include_once(VIEWS_PATH.'login.php');
if(isset($message) && $message!=""){
  echo '<script type="text/javascript">';
  echo ' alert("'.$message.'")'; 
  echo '</script>';
}
?>
<form method="POST" padding: 2rem !important;" action=<?php echo FRONT_ROOT."MovieFunction/showAddViewRoom";?>>
		<div align="center">
     		<h2>Seleccione cine </h2>
			<?php
				echo "<select name = cinemaId>";
				foreach($cinemas as $cine){
					echo "<option value = ".$cine->getId()."> ".$cine->getName()."</option>";
				}
				echo "</select>";?>
				<br>
     			<button type="submit">Cargar funcion</button>
    </form>
</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>
