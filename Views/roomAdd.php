<form method="POST" padding: 2rem !important;" action=<?php echo FRONT_ROOT."Room/Add";?>>
		<div align="center">
			 <h2>Alta de sala </h2>
			 <div class="form-register"> 
				 <div class="form-register-ul">
     			<input style="width:50%" type="text" name="name" placeholder="Nombre de sala" required class="form-control">
			<br>
     			<input style="width:50%" type="number" name="capacity" placeholder="Capacidad de sala" required class="form-control" min = "50" max = "1000">
			<br>
				<input type="hidden" name="cinemaId" value = <?php echo $cinemaId ?>>
     			<button type="submit">Cargar</button>
    </form>
</div>
</div>
</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>