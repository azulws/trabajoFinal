<?php
if($lista==false){
	echo '<script>alert("No hay peliculas en la base de datos");</script>';
}else{
	foreach($lista as $item){
		echo '<select class="form-control" id="exampleFormControlSelect1">
        <option value = '.$item.' >'.item->getMovieName();.'</option>
      </select>';	
	}
}
?>