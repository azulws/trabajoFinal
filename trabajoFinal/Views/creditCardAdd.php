<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."CreditCard/Add";?>>
		<div align="center">
     		<h2>Alta de cinema </h2>
     			<input type="number" name="number" placeholder="description" required class="form-control" min="100000000000">
			<br>
     			<input type="text" name="description" placeholder="Address" required class="form-control" >
			<br>
     			<input type="number" name="segurityCode" value="captotal"placeholder="codigo de seguridad" required class="form-control" min="001" max="999">
			<br>
     			<input type="month" name="expirationDate" value="ticket" placeholder="fecha de expiracion" required class="form-control" min="<?php echo "20".date("y-m");?>">
			<br>
     			<button type="submit">Cargar</button>
    </form>

</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>