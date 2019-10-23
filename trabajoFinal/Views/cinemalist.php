<?php

foreach($lista as $item){
	echo '<dl>'.
			'<dt> cinema: '.$item->getName().'<dt>'.
			'<dd> Adress: '.$item->getAdress().'</dd>'.
			'<dd> Capacity: '.$item->getCapacity().'</dd>'.
			'<dd> Valor de la entrada $'.$item->getTicketValue().'</dd>'.
			'<form action="'.FRONT_ROOT.'cinema/Remove">
			<button name="name" value="'.$item->getName().'">Eliminar</button></form>'.
		'</dl>';
}
echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
<button>Volver</button></form>';
?>