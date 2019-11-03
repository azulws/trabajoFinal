<?php
if($lista==false){
	echo '<script>alert("No hay funciones en la base de datos");</script>';
}else{
	foreach($lista as $item){
		echo "<h2>"."Cine: ".$item->getCinemaId()."</h2>";
		echo '<dl>'.
				'<dt> Pelicula: '.$item->getMovieId().'<dt>'.
				'<dd> Fecha y hora: '.$item->getStartDatetime().'</dd>'.
			'</dl>';
		echo '<form action="'.FRONT_ROOT.'MovieFunction/RemoveDB">
		<button name="name" value="'.$item->getMovieFunctionId().'">Eliminar</button></form>';
	}
}

echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
	<button>Volver</button></form>';
?>