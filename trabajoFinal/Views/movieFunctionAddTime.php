<?php
include_once(VIEWS_PATH.'login.php');
if($message!=""){
  echo '<script type="text/javascript">';
  echo ' alert("'.$message.'")'; 
  echo '</script>';
}
?>
<?php
	if($response!=false){
		echo '<h2> FUNCIONES CARGADAS </h2>';
		foreach($response as $item){
			echo '<dl>'.
				'<dt> Pelicula: '.$item->getMovie()->getTitle().'<dt>'.
				'<dt> Cine: '.$item->getCinema()->getName().'<dt>'.
				'<dd> Fecha y hora: '.$item->getStartDatetime().'</dd>'.
				'</dl>';
		}
	}
?>
<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."MovieFunction/validateFunctionByTime";?>>
		<div align="center">
     		<h2>Elegir horario </h2>
			 <p><?php $message;?><p>
			 	<!-- Add($cinemaId,$movieId,$date) -->
				<input type = "hidden" name="cinemaId" value= <?php echo $cineId;?>>
				<input type = "hidden" name="movieId" value= <?php echo $movId;?>>
				<input readonly name="date" value= <?php echo $d;?>>
				<?php if($d != "20".date("y-m-d")) echo "<input type='time' name = 'time' min='15:00' max='23:00' required>";
						else {
							if(date("H:i")>="15:00"){
								echo "<input type='time' name = 'time' min='".date("H:i")."' max='23:00' required>";
							}else{
								echo "<input type='time' name = 'time' min='15:00' max='23:00' required>";
							}
							}?>
				<br><br><br>
     			<button type="submit">Cargar funcion</button>
		</div>
</form>

<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>
