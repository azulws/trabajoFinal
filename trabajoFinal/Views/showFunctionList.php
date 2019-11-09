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
      <div class="scrollable">
      <form action="<?php echo FRONT_ROOT."MovieFunction/removeDB"?>" method="POST">
        <table style="text-align:center;">
          <thead class="bgColor">
            <tr>
              <th style="width: 30%;">Pelicula</th>
              <th style="width: 10%;">Duración (mins)</th>
              <th style="width: 20%;">Cine</th>
              <th style="width: 30%;">Inicio - Fin</th>
              <th style="width: 10%;">Valor entrada</th>
              <th style="width: 10%;">Acción</th>
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
                    <td class="border"><?php echo $item->getCinema()->getName() ?></td>
                    <td class="border"><?php echo $item->getStartDateTime().' - '.date("H:i",strtotime($item->getEndDateTime($item->getMovie()))) ?></td>
					          <td class="border"><?php echo '$ '.$item->getCinema()->getTicketValue() ?></td>
                    <td class="border">
                      <button type="submit" name="id" class="btn" value="<?php echo $item->getMovieFunctionId() ?>"> Eliminar </button>
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