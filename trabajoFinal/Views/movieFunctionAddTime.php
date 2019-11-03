<?php
	if($response!=false){
		echo '<h2> FUNCIONES CARGADAS </h2>';
		foreach($response as $item){
			echo '<dl>'.
				'<dt> Pelicula: '.$item->getMovieId().'<dt>'.
				'<dt> Cine: '.$item->getCinemaId().'<dt>'.
				'<dd> Fecha y hora: '.$item->getStartDatetime().'</dd>'.
				'</dl>';
		}
	}
?>
<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."MovieFunction/validateFunctionByTime";?>>
		<div align="center">
     		<h2>Elegir horario </h2>
			 	<!-- Add($cinemaId,$movieId,$date) -->
				<input readonly name="cinemaId" value= <?php echo $cineId;?>>
				<input readonly name="movieId" value= <?php echo $movId;?>>
				<input readonly name="date" value= <?php echo $d;?>>
				<input type="time" name = "time" min='15:00' max='23:00'>
				<br><br><br>
     			<button type="submit">Cargar funcion</button>
		</div>
</form>

<?php
echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
<button>Volver</button></form>';
?>
