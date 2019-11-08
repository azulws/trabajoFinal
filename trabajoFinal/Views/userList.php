<?php
/*if($lista==false){
	echo '<script>alert("No hay usuarios base de datos");</script>';
}else{
        echo "<h2>Usuarios</h2>";
        $i = 0;
	foreach($lista as $user){
                if($user->getRole()==2){
                echo '<dl>'.
                        '<dt> email: '.$user->getEmail().'<dt>'.
                        '<dd> name: '.$user->getName().'</dd>'.
                        '<dd> lastname: '.$user->getLastName().'</dd>'.
                        '<dd> DNI: '.$user->getDni().'</dd>'.
                        '<form action="'.FRONT_ROOT.'Login/RemoveDB">
                                <button name="email" value="'.$user->getEmail().'">Eliminar</button>
                        </form>'.
	                '<form action="'.FRONT_ROOT.'Login/UpdateRoleDB">
                                <button name="name" value="'.$user->getEmail().'">Change</button>
                        </form>'.
                '</dl>';
                $i++;	
                }
        }
        if($i==0){
                echo "NO HAY USUARIOS CARGADOS";
        }
        echo "<h2>Admin</h2>";
        $i = 0;
        foreach($lista as $user){
        if($user->getRole()==1){
                echo '<dl>'.
                        '<dt> email: '.$user->getEmail().'<dt>'.
                        '<dd> name: '.$user->getName().'</dd>'.
                        '<dd> lastname: '.$user->getLastName().'</dd>'.
                        '<dd> DNI: '.$user->getDni().'</dd>'.
                        '<form action="'.FRONT_ROOT.'Login/RemoveDB">
                                <button name="email" value="'.$user->getEmail().'">Eliminar</button>
                        </form>'.
                        '<form action="'.FRONT_ROOT.'Login/UpdateRoleDB">
                                <button name="name" value="'.$user->getEmail().'">Change</button>
                        </form>'.
                '</dl>';	
                $i++;	
                }
                
        }
        if($i==0){
                echo "NO HAY ADMINISTRADORES CARGADOS";
        }
}
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
*/?>
<?php
include_once(VIEWS_PATH.'login.php');
?>
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
      <form action="<?php echo FRONT_ROOT."Login/receiveAction"?>" method="POST">
        <table style="text-align:center;">
          <thead class="bgColor">
            <tr>
              <th style="width: 30%;">Usuario</th>
              <th style="width: 10%;">Rol</th>
              <th style="width: 30%;">Nombre</th>
              <th style="width: 30%;">Apellido</th>
              <th style="width: 20%;">Dni</th>
              <th style="width: 20%;">Cambiar Rol</th>
              <th style="width: 20%;">Eliminar</th>
            </tr>
          </thead>
          <tbody class="bgColor">
            <?php
              foreach($lista as $user)
              {
                ?>
                  <tr class="bgColor">
                    <td class="border"><?php echo $user->getEmail() ?></td>
                    <td class="border"><?php echo $user->getRole() ?></td>
                    <td class="border"><?php echo $user->getName() ?></td>
                    <td class="border"><?php echo $user->getLastName() ?></td>
		    <td class="border"><?php echo $user->getDni() ?></td>
                    <td class="border">
                    <input type="submit" name = "email" value="<?php echo $user->getEmail() ?>" formaction=<?php echo FRONT_ROOT.'Login/UpdateRoleDB'?>>
                    </td>
                    <td class="border">
                    <input type="submit" name = "email" value="<?php echo $user->getEmail() ?>" formaction=<?php echo FRONT_ROOT.'Login/RemoveDB'?>>
                    </td>
                 
                  </tr>
                <?php

              }
            ?>                          
          </tbody>
        </table></form> 
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
