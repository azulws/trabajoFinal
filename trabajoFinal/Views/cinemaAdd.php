<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."Cinema/AddDB";?>>
		<div align="center">
     		<h2>Alta de cinema </h2>
     			<input type="text" name="name" placeholder="Name" required class="form-control">
			<br>
     			<input type="text" name="address" placeholder="Address" required class="form-control" >
			<br>
     			<input type="number" name="captotal" value="captotal"placeholder="capacity total" required class="form-control" min="10">
			<br>
     			<input type="number" name="ticket" value="ticket" placeholder="precio ticket" required class="form-control" min="1">
			<br>
     			<button type="submit">Cargar</button>
    </form>

</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
<button>Volver</button></form>';
?>