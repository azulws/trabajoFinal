<?php
include_once(VIEWS_PATH.'login.php');
?>
<form method="POST" padding: 2rem !important;" action=<?php echo FRONT_ROOT."CreditCard/add";?>>
		<div align="center">
     		<h2>Alta de tarjeta</h2>
			 <div class="form-register"> 
				 <div class="form-register-ul">
				<select style="width:268px" name="description">
					<option value="visa">Visa</option>
					<option value="master">Master</option>
				</select>
				<input type="hidden" name="user" value="<?php echo $_SESSION['logged']->getEmail()?>">
				<br><br>
				<p> Numero de tarjeta de crédito </p>
				<input class=""type="text" name="number1" placeholder="----" required pattern="[0-9]{4}">-
                <input class=""type="text" name="number2" placeholder="----" required pattern="[0-9]{4}">-
				<input class=""type="text" name="number3" placeholder="----" required pattern="[0-9]{4}">
				<br><br>
				<p> Código de seguridad </p>
     			<input style="width:268px"type="text" name="securityCode" placeholder="---" required pattern="[0-9]{3}">
				<br><br>
				<p> Fecha de expiración </p>
				 <input style="width:268px"type="date" name="expirationDate" value="expirationDate" placeholder="fecha de expiracion" required min="<?php echo "20".date("y-m-d");?>">
				 <br><br>
				 <button type="submit">Cargar</button>
</div>
</div>
    </form>

</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>