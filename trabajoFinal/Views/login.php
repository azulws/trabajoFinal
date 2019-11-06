<?php
if(!isset($_SESSION['logged']))
{
    echo 'Estas logeado con la cuenta de: '.$_SESSION['name'];
    echo "<form class='login' action='".FRONT_ROOT."Login/logout' method='POST'>
        <button type='submit' name='action'>Desconectar</button>
    </form>";
    echo"estoy aca";
    
}else{
   
    echo "<form class='login' action='".FRONT_ROOT."Login/receiveAction' method='POST'> 
    <h2>Bienvenido</h2>
    <fieldset>
        <input type='email' class='email' placeholder='mail' name='user_mail' required>
        <input type='password' class='password' placeholder='password' name='user_password' required>
    </fieldset>
    <button type='submit' name='action' value='Ingresar'>Ingresar</button>
    </form>
    <form class='login' action='".FRONT_ROOT."Login/receiveAction' method='POST'> 
    <button type='submit' name='action' value='Registrar'>Registrar</button>
    </form>";   
}   //TODO cambiar loguin para loguear con DB
?>
