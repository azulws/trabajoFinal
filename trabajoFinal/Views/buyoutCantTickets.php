<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."Buyout/showBuyoutForm";?>>
		<div align="center">
     		<h2>Elegir cantidad entradas</h2>
     			<?php echo "<h3>Entradas disponibles: ".$ticketsLeft."</h3>";?>
				<?php echo "<h4>Precio de entrada: $".$price."</h4>";?>
			<br>
				<input type="hidden" name="movieFunctionId" value="<?php echo $movieFunctionId?>">
                <input type="number" name="cantTicket" placeholder="Cant" required min=1 max=<?php echo $ticketsLeft?>>
            <br>	
     			<button type="submit">Continuar</button>
    </form>

</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Cancelar</button></form>';
?>