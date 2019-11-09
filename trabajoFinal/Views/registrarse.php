<form method="POST" style="background-image:url('../Views/img/fondo1.jpg');padding: 2rem !important;" action=<?php echo FRONT_ROOT."Login/createUserDB";?>>
		<div align="center">
     		<h2>Registro de usuario</h2>
             <input type="text" name="name" placeholder="Name" required>
			<br>
            <input type="text" name="lastname" placeholder="Lastname" required>
            <br>
             <input type="email" name="email" placeholder="Email" required>
     		<br>
             <input type="password" name="password" placeholder="Contraseña" required>
            <br>
            <input type="number" name="dni" placeholder="dni" required min=1000000>
            <br>
            <button type="submit" name="register">Registrarse</button>
         </div>
    </form>
<?php
echo "<form class='login' action='".FRONT_ROOT."Login/Index' method='POST'>
        <button type='submit' name='action'>Volver</button>
    </form>";
?>
