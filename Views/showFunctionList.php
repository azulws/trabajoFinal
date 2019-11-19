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
    <form method = "POST" action = <?php echo FRONT_ROOT."MovieFunction/showAddViewRoom" ?>>
        <button id="buttons" class="btn btn-danger float-right" type="submit" name = "cineId" value = <?php echo $cinemaId ?>>+ Función</button>
      </form>
      <div class="scrollable">
        <table style="text-align:center;">
          <thead class="bgColor">
            <tr>
              <th style="width: 30%;">Pelicula</th>
              <th style="width: 10%;">Duración (mins)</th>
              <th style="width: 20%;">Cine</th>
              <th style="width: 20%;">Sala</th>
              <th style="width: 30%;">Inicio - Fin</th>
              <th style="width: 10%;">Valor entrada</th>
              <th style="width: 10%;">Eliminar</th>
              <th style="width: 10%;">Ventas</th>
            </tr>
          </thead>
          <tbody class="bgColor">
            <?php
              if($lista!=false) foreach($lista as $item)
              {
                ?>
                  <tr>
                    <td class="border"><?php echo $item->getMovie()->getTitle() ?></td>
                    <td class="border"><?php echo $item->getMovie()->getRuntime() ?></td>
                    <td class="border"><?php echo $item->getRoom()->getCinema()->getName() ?></td>
                    <td class="border"><?php echo $item->getRoom()->getName() ?></td>
                    <td class="border"><?php echo $item->getStartDateTime().' - '.date("H:i",strtotime($item->getEndDateTime($item->getMovie()))) ?></td>
					          <td class="border"><?php echo '$ '.$item->getRoom()->getCinema()->getTicketValue() ?></td>
                    <td class="border">
                    <form action="<?php echo FRONT_ROOT."MovieFunction/removeDB"?>" method="POST">
                      <input type="hidden" name="cinemaId" value="<?php echo $item->getRoom()->getCinema()->getId() ?>">
                      <button type="submit" name="id" class="" value="<?php echo $item->getMovieFunctionId() ?>"> Eliminar </button>
                      </form>
                    </td>
                    <td class="border">
                    <form action="<?php echo FRONT_ROOT."Ticket/showSales"?>" method="POST">
                      <button type="submit" name="id" class="" value="<?php echo $item->getMovieFunctionId() ?>"> Ver Ventas </button>
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
