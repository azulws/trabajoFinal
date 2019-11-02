<?php
if($lista==false){
	echo '<script>alert("No hay funciones en la base de datos");</script>';
}else{
	foreach($lista as $item){
		echo '<dl>'.
				'<dt> Pelicula: '.$item->getMovieId().'<dt>'.
				'<dt> Cine: '.$item->getCinemaId().'<dt>'.
				'<dd> Fecha y hora: '.$item->getStartDatetime().'</dd>'.
			'</dl>';
	}
}

echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
	<button>Volver</button></form>';
?>