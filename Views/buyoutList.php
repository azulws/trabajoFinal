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
              <th style="width: 30%;">Id compra</th>
              <th style="width: 40%;">User</th>
              <th style="width: 10%;">Fecha de compra</th>
              <th style="width: 10%;">Cantidad de entradas</th>
              <th style="width: 10%;">Total</th>
              <th style="width: 10%;">Descuento</th>
              <th style="width: 10%">TotalFinal</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="bgColor">
            <?php
            $totalFuncion=0;
              if($ticketList!=false) foreach($ticketList as $item)
              {
                ?>
                  <tr>
                    <td class="border"><?php echo $item->getBuyout()->getId() ?></td>
                    <td class="border"><?php echo $item->getBuyout()->getUser()->getEmail() ?></td>
                    <td class="border"><?php echo $item->getBuyout()->getBuyDate() ?></td>
                    <td class="border"><?php echo $item->getBuyout()->getCantTicket() ?></td>
                    <td class="border"><?php echo $item->getBuyout()->getTotal() ?></td>
                    <td class="border"><?php echo $item->getBuyout()->getDiscount() ?></td>
                    <td class="border"><?php echo ($item->getBuyout()->getTotal() - $item->getBuyout()->getDiscount()) ?></td>
                  </tr>
                <?php
                $totalFuncion+=($item->getBuyout()->getTotal() - $item->getBuyout()->getDiscount());
              }
            ?>                          
          </tbody>
        </table> 
        <?php echo "<h2>Total recaudado por la funcion: $".$totalFuncion."<h2>" ?>
      </div>
    </div>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>