<?php
if($lista==false)
{
	echo '<script>alert("No hay funciones en la base de datos");</script>';
}else
	{
		foreach($lista as $item)
		{   
			$movie = $this->movieDBDAO->read($item->getMovieId());
        	$item->setEndDateTime($movie);
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
		}
}
		 
?>