<?php
include_once(VIEWS_PATH.'login.php');
?>
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
      <form method="POST">
        <table style="text-align:center;">
          <thead class="bgColor">
            <tr>
              <th style="width: 30%;">Nombre</th>
              <th style="width: 30%;">Dirección</th>
              <th style="width: 20%;">Capacidad</th>
              <th style="width: 20%;">Precio ($)</th>
              <th style="width: 20%;">Modificar</th>
              <th style="width: 20%;">Eliminar</th>
            </tr>
          </thead>
          <tbody class="bgColor">
            <?php
              foreach($lista as $cinema)
              {
                ?>
                  <tr class="bgColor">
                    <td class="border"><?php echo $cinema->getName() ?></td>
                    <td class="border"><?php echo $cinema->getAddress() ?></td>
                    <td class="border"><?php echo $cinema->getCapacity() ?></td>
                    <td class="border"><?php echo $cinema->getTicketValue() ?></td>
                    <td class="border">
                    <input type="submit" name = "id" value="<?php echo $cinema->getId() ?>" formaction=<?php echo FRONT_ROOT.'Cinema/ShowUpdateCinema'?>>
                    </td>
                    <td class="border">
                    <input type="submit" name = "id" value="<?php echo $cinema->getId() ?>" formaction=<?php echo FRONT_ROOT.'Cinema/RemoveDB'?>>
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
