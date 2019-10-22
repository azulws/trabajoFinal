
<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."Cine/Add";?>>
		<div align="center">
     		<h2>Alta de cine </h2>
     			<input type="text" name="nombre" placeholder="Nombre" required class="form-control">
			<br>
     			<input type="text" name="direccion" placeholder="Direccion" required class="form-control" >
			<br>
     			<input type="number" name="captotal" value="captotal"placeholder="capacidad total" required class="form-control">
			<br>
     			<input type="number" name="ticket" value="ticket" placeholder=" precio ticket" required class="form-control">
			<br>
     			<button type="submit">Cargar</button>
    </form>

</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
<button>Volver</button></form>';
?>