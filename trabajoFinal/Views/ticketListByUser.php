<?php
include_once(VIEWS_PATH.'login.php');
?>
<div class="wrapper row4">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content"> 
      <div class="scrollable">
        <table style="text-align:center;">
          <thead class="bgColor">
            <tr>
              <th style="width: 30%;">Pelicula</th>
              <th style="width: 30%;">Fecha</th>
              <th style="width: 20%;">Numero Compra</th>
              <th style="width: 20%;">Qr</th>
            </tr>
          </thead>
          <tbody class="bgColor">
            <?php
              if($ticketsUser!=false)foreach($ticketsUser as $ticket)
              {
                ?>
                  <tr class="bgColor">
                    <td class="border"><?php echo $ticket->getmovieFunction()->getMovie()->getTitle() ?></td>
                    <td class="border"><?php echo $ticket->getmovieFunction()->getStartDateTime() ?></td>
                    <td class="border"><?php echo $ticket->getBuyout()->getId() ?></td>
                    <td class="border"><?php echo "<img src=".$ticket->getQr().">" ?></td>
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