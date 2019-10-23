<?php

foreach($lista as $item){
	echo '<dl>'.
			'<dt> cinema: '.$item->getNombre().'<dt>'.
			'<dd> Direccion: '.$item->getDireccion().'</dd>'.
			'<dd> Capacidad: '.$item->getCapacidad().'</dd>'.
			'<dd> Valor de la entrada $'.$item->getValorEntrada().'</dd>'.
			'<form action="'.FRONT_ROOT.'cinema/Remove">
			<button name="nombre" value="'.$item->getNombre().'">Eliminar</button></form>'.
		'</dl>';
}
echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
<button>Volver</button></form>';
?>