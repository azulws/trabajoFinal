<?php
if($lista==false){
	echo '<script>alert("No hay funciones en la base de datos");</script>';
}else{
    /*echo "<h2>Cinema: '.$item->getCinema()->getName()</h2>"

    <form action= echo FRONT_ROOT."MovieFunction/Add">
    <button name="name" value="'.$item->getName().'">AÑADIR FUNCIONES</button>
    </form>"*/
	foreach($lista as $item){
		echo '<dl>'.
				'<dt> Pelicula: '.$item->getMovieId().'<dt>'.
				'<dt> Cine: '.$item->getCinemaId().'<dt>'.
				'<dd> Fecha y hora: '.$item->getStartDatetime().'</dd>'.
				/*'<form action="'.FRONT_ROOT.'function/RemoveDB">
				<button name="name" value="'.$item->getName().'">Eliminar</button></form>'.
				*/
			'</dl>';
	}
}

echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
	<button>Volver</button></form>';
?>