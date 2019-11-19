<form method="POST" padding: 2rem !important; action=<?php echo FRONT_ROOT."Buyout/showBuyoutForm";?>>
		<div align="center">
			 <h2>Elegir cantidad entradas</h2>
			 	<div class="form-register"> 
				<div class="form-register-ul">
     			<?php echo "<h3 style=color:white>Entradas disponibles: ".$ticketsLeft."</h3>";?>
				<?php echo "<h4 style=color:white>Precio de entrada: $".$price."</h4>";?>
			<br>
				<input type="hidden" name="movieFunctionId" value="<?php echo $movieFunctionId?>">
                <input style="width:30%"class="form-register-input" type="number" name="cantTicket" placeholder="Cant" required min=1 max=<?php echo $ticketsLeft?>>
				 <button type="submit">Continuar</button>
				 <br><br>
				 <div>
			<div>
		</div>
</form>
				

<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Cancelar</button></form>';
?>