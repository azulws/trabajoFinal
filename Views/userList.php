<?php
include_once(VIEWS_PATH.'login.php');
if(isset($message) && $message!=""){
  echo '<script type="text/javascript">';
  echo ' alert("'.$message.'")'; 
  echo '</script>';
}
?>
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
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
                if($user->getEmail()!="admin@admin.com"){
                ?>
                  <tr class="bgColor">
                    <td class="border"><?php echo $user->getEmail() ?></td>
                    <td class="border"><?php echo ($user->getRole()->getId()==1) ? "Admin" : "Usuario";?></td>
                    <td class="border"><?php echo $user->getName() ?></td>
                    <td class="border"><?php echo $user->getLastName() ?></td>
		                <td class="border"><?php echo $user->getDni() ?></td>
                    <td class="border">
                      <form action=<?php echo FRONT_ROOT.'Login/UpdateRoleDB'?> method = "POST">
                        <input type="hidden" name = "email" value=<?php echo $user->getEmail() ?>>
                        <button type=submit> Modificar </button>
                      </form>
                    </td>
                    <td class="border">
                      <form action=<?php echo FRONT_ROOT.'Login/RemoveDB'?> method = "POST">
                        <input type="hidden" name = "email" value="<?php echo $user->getEmail() ?>">
                        <button type=submit> Eliminar </button>
                      </form>
                    </td>
                 </tr>
                <?php
                }
              }
            ?>                          
          </tbody>
        </table> 
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
