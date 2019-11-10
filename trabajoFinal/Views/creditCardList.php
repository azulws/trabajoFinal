<?php
include_once(VIEWS_PATH.'login.php');
if($message!=""){
  echo '<script type="text/javascript">';
  echo ' alert("'.$message.'")'; 
  echo '</script>';
}
?>
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
    <form method = "POST" action = <?php echo FRONT_ROOT."creditCard/showViewAdd" ?>>
        <button id="buttons" class="btn btn-danger float-right" type="submit">+ Tarjeta</button>
      </form>
      <div class="scrollable">
      <form action="<?php echo FRONT_ROOT."CreditCard/removeDB"?>" method="POST">
        <table style="text-align:center;">
          <thead class="bgColor">
            <tr>
              <th style="width: 30%;">Tarjeta</th>
              <th style="width: 40%;">Numero</th>
              <th style="width: 10%;">Fecha de expiracion</th>
              <th style="width: 10%;">Codigo de seguridad</th>
            </tr>
          </thead>
          <tbody class="bgColor">
            <?php
              if($lista!=false) foreach($lista as $item)
              {
                ?>
                  <tr>
                    <td class="border"><?php echo $item->getDescription() ?></td>
                    <td class="border"><?php echo $item->getNumber() ?></td>
                    <td class="border"><?php echo $item->getExpirationDate() ?></td>
                    <td class="border"><?php echo $item->getSecurityCode() ?></td>
                    <td>
                    <button type="submit" name="id" class="btn" value="<?php echo $item->getId() ?>"> Eliminar </button>
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