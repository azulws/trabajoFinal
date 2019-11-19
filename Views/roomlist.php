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
    <form method = "POST" action = <?php echo FRONT_ROOT."Room/ShowAddView" ?>>
        <button id="buttons" class="btn btn-danger float-right" type="submit" name = "cinemaId" value = <?php echo $cinemaId?> >+ Sala</button>
      </form>
      <div class="scrollable">
        <table style="text-align:center;">
          <thead class="bgColor">
            <tr>
              <th style="width: 65%;">Nombre</th>
              <th style="width: 10%;">Capacidad</th>
              <th style="width: 20%;">Modificar</th>
              <th style="width: 20%;">Eliminar</th>
            </tr>
          </thead>
          <tbody class="bgColor">
            <?php
              if($lista!=false)foreach($lista as $room)
              {
                ?>
                  <tr class="bgColor">
                    <td class="border"><?php echo $room->getName() ?></td>
                    <td class="border"><?php echo $room->getCapacity() ?></td>
                    <td class="border">
                      <form action=<?php echo FRONT_ROOT.'Room/ShowUpdateRoom'?> method = "POST">
                        <input type="hidden" name = "id" value=<?php echo $room->getId() ?>>
                        <button type=submit> Modificar </button>
                      </form>
                    </td>
                    <td class="border">
                      <form action=<?php echo FRONT_ROOT.'Room/Remove'?> method = "POST">
                        <input type="hidden" name = "id" value=<?php echo $room->getId() ?>>
                        <input type="hidden" name = "cinemaId" value=<?php echo $room->getCinema()->getId()?>>
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
