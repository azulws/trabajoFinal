<form method="POST" padding: 2rem !important;" action=<?php echo FRONT_ROOT."Cinema/AddDB";?>>
		<div align="center">
			 <h2>Alta de cinema </h2>
			 <div class="form-register">
			 <div class="form-register-ul">
     			<input style="width: 50%;"class="form-register-input" type="text" name="name" placeholder="Nombre" required class="form-control">
     			<input style="width: 50%;"class="form-register-input" type="text" name="address" placeholder="Dirección" required class="form-control" >
     			<input style="width: 50%;"class="form-register-input" type="number" name="ticket" value="ticket" placeholder="Precio ticket" required class="form-control" min="1">
				 <button type="submit">Cargar</button>
</div>
</div>
    </form>

</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>