<?php
if($lista==false){
	echo '<script>alert("No hay funciones en la base de datos");</script>';
}else{
    echo "<h2>Cinema: '.$item->getCinema()->getName()</h2>"

    echo "<form action="'.FRONT_ROOT.'function/Añadir">
    <button name="name" value="'.$item->getName().'">AÑADIR FUNCIONES</button>
    </form>"
	foreach($lista as $item){
		echo '<dl>'.
				'<dt> Pelicula: '.$item->getMovie()->getTitle().'<dt>'.
				'<dd> Fecha y hora: '.$item->getStartDatetime().'</dd>'.
				/*'<form action="'.FRONT_ROOT.'function/RemoveDB">
				<button name="name" value="'.$item->getName().'">Eliminar</button></form>'.
				*/
			'</dl>';
	}
}

<form action="<?php echo FRONT_ROOT."cinema/showcinemaListDB";?>">
    <button>Volver</button>
</form>
?>