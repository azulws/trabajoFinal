<form class="login" action="<?php echo FRONT_ROOT."Login/receiveAction";?>" method="POST"> 
    <h2>Bienvenido</h2>
    <fieldset>
        <input type="email" class="email" placeholder="mail" name="user_mail" required>
        <input type="password" class="password" placeholder="password" name="user_password" required>
    </fieldset>
    <button type="submit" name="action" value="Ingresar">Ingresar</button>
    <button type="submit" name="action" value="Registrar">Registrar</button>
</form>
