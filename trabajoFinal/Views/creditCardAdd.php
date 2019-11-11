<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."CreditCard/add";?>>
		<div align="center">
     		<h2>Alta de tarjeta</h2>
     			
			<br>
				<select name="description">
					<option value="visa">Visa</option>
					<option value="master">Master</option>
				</select>
				<input type="hidden" name="user" value="<?php echo $_SESSION['logged']->getEmail()?>">
			<br><br>
				<input type="number" name="number1" placeholder="----" required min="1000" max="9999">-
                <input type="number" name="number2" placeholder="----" required min="1000" max="9999">-
                <input type="number" name="number3" placeholder="----" required min="1000" max="9999">
			<br>
     			<input type="number" name="securityCode" value="securityCode"placeholder="codigo de seguridad" required min="001" max="999">
			<br>
     			<input type="date" name="expirationDate" value="expirationDate" placeholder="fecha de expiracion" required min="<?php echo "20".date("y-m-d");?>">
			<br>
     			<button type="submit">Cargar</button>
    </form>

</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>