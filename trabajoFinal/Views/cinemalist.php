<?php
if($lista==false){
	echo '<script>alert("No hay cines en la base de datos");</script>';
}else{
	foreach($lista as $item){
		echo '<dl>'.
				'<dt> Cine: '.$item->getName().'<dt>'.
				'<dd> Dirección: '.$item->getAddress().'</dd>'.
				'<dd> Capacidad: '.$item->getCapacity().'</dd>'.
				'<dd> Valor de la entrada: $'.$item->getTicketValue().'</dd>'.
				'<form action="'.FRONT_ROOT.'cinema/RemoveDB">
				<button name="id" value="'.$item->getId().'">Eliminar</button></form>'.
				'<form action="'.FRONT_ROOT.'cinema/ShowUpdateCinema">
				<button name="id" value="'.$item->getId().'">Modificar</button>
				</form>'.
			'</dl>';
	}
}
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>