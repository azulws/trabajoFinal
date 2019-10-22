<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."Login/createUser";?>>
		<div align="center">
     		<h2>Registro de usuario</h2>
             <input type="text" name="nombre" placeholder="Nombre">
			<br>
            <input type="text" name="apellido" placeholder="Apellido">
            <br>
             <input type="email" name="email" placeholder="Email">
     		<br>
             <input type="password" name="password" placeholder="Contraseña">
            <br>
            <input type="number" name="dni">
            <br>
            <button type="submit" name="register">Registrarse</button>
    </form>

</div>