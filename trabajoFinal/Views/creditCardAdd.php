<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."CreditCard/add";?>>
		<div align="center">
     		<h2>Alta de cinema </h2>
     			<input type="number" name="number" placeholder="number" required class="form-control" min="100000000000" max="999999999999">
			<br>
				<select name="description">
					<option value="visa">Visa</option>
					<option value="master">Master</option>
				</select>
				<input type="hidden" name="user" value="<?php echo $_SESSION['logged']->getEmail()?>">
			<br>
     			<input type="number" name="segurityCode" value="segurityCode"placeholder="codigo de seguridad" required class="form-control" min="001" max="999">
			<br>
     			<input type="date" name="expirationDate" value="expirationDate" placeholder="fecha de expiracion" required class="form-control" min="<?php echo "20".date("y-m-d");?>">
			<br>
     			<button type="submit">Cargar</button>
    </form>

</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>