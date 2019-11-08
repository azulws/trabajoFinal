<?php
<<<<<<< HEAD
		echo '<dl>'.
		        '<dt> MovieFunction:'.(int)$item->getMovieFunctionId().'<dt>'.
				'<dt> Pelicula: '.$movie->getTitle().'<dt>'.
				'<dt> Duracion: '.$movie->getRuntime().'<dt>'.
				'<dt> Cine: '.$item->getCinemaId().'<dt>'.
				'<dd> Inicio: '.$item->getStartDatetime().'</dd>'.
				'<dd> Finalizacion: '.$item->getEndDateTime().'</dd>'.
				'<dd> Valor entrada: '.$cinema->getTicketValue().'</dd>'.
			'</dl>';		
			echo '<form action="'.FRONT_ROOT.'MovieFunction/RemoveDB">
	     	<button name="name" value="'.$item->getCinemaId().'">Eliminar</button></form>';
		
			 echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
			<button>Volver</button></form>';
=======
if($lista==false)
{
	echo '<script>alert("No hay funciones en la base de datos");</script>';
}else
	{
		foreach($lista as $item)
		{   
			echo '<dl>'.
		        //'<dt> MovieFunction:'.$item->getMovieFunctionQr()->getImage().'<dt>'.
				'<dt> Pelicula: '.$item->getMovie()->getTitle().'<dt>'.
				'<dt> Duracion: '.$item->getMovie()->getRuntime().'<dt>'.
				'<dt> Cine: '.$item->getCinema()->getName().'<dt>'.
				'<dd> Inicio: '.$item->getStartDateTime().'</dd>'.
				'<dd> Finalizacion: '.$item->getEndDateTime($item->getMovie()).'</dd>'.
				'<dd> Valor entrada: '.$item->getCinema()->getTicketValue().'</dd>'.
			'</dl>';		
			echo '<form action="'.FRONT_ROOT.'MovieFunction/RemoveDB">
	     	<button name="name" value='.$item->getCinema()->getId().'>Eliminar</button></form>';
		
			
		}
		echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
		<button>Volver</button></form>';
}
>>>>>>> entrega
		 
?>