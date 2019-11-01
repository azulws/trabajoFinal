<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."MovieFunction/Add";?>>
		<div align="center">
     		<h2>Alta de funcion </h2>
     			<input type="date" name="date" placeholder="Name" required class="form-control">
			<br>
     			<input type="int" name="movieId" placeholder="movieId" required class="form-control" >
			<br>
                <input type="int" name="cinemaId" placeholder="cinemaId" required class="form-control" >
			<br>
     			<button type="submit">Cargar funcion</button>
    </form>

</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
<button>Volver</button></form>';
?>