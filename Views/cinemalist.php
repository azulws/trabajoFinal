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
    <form method = "POST" action = <?php echo FRONT_ROOT."Cinema/showAddView" ?>>
        <button id="buttons" class="btn btn-danger float-right" type="submit">+ Cine</button>
      </form>
      <div class="scrollable">
        <table style="text-align:center;">
          <thead class="bgColor">
            <tr>
              <th style="width: 30%;">Nombre</th>
              <th style="width: 30%;">Dirección</th>
              <th style="width: 20%;">Precio ($)</th>
              <th style="width: 20%;">Modificar</th>
              <th style="width: 30%;">Salas</th>
              <th style="width: 20%;">Eliminar</th>
            </tr>
          </thead>
          <tbody class="bgColor">
            <?php
              if($lista!=false)foreach($lista as $cinema)
              {
                ?>
                  <tr class="bgColor">
                    <td class="border"><?php echo $cinema->getName() ?></td>
                    <td class="border"><?php echo $cinema->getAddress() ?></td>
                    <td class="border"><?php echo $cinema->getTicketValue() ?></td>
                    <td class="border">
                      <form action=<?php echo FRONT_ROOT.'Cinema/ShowUpdateCinema'?> method = "POST">
                        <input type="hidden" name = "id" value=<?php echo $cinema->getId() ?>>
                        <button type=submit> Modificar </button>
                      </form>
                    </td>
                    <td class="border">
                      <form action=<?php echo FRONT_ROOT.'Room/showRoomList'?> method = "POST">
                        <input type="hidden" name = "id" value=<?php echo $cinema->getId() ?>>
                        <button type=submit> Salas </button>
                      </form>
                    </td>
                    <td class="border">
                      <form action=<?php echo FRONT_ROOT.'Cinema/RemoveDB'?> method = "POST">
                        <input type="hidden" name = "id" value=<?php echo $cinema->getId() ?>>
                        <button type=submit> Eliminar </button>
                      </form>
                    </td>
                  </tr>
                <?php
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
