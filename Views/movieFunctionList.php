<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Funciones de <?php echo $movie->getTitle()?></h2>
               <form action="<?php echo FRONT_ROOT."Buyout/countTicketsForm"?>" method="POST">
                    <table class="table bg-light">
                         <thead class="bg-dark text-white">
                              <th style="width: 20%;">Horarios</th>
                              <th style="width: 20%;">Cine</th>
                              <th style="width: 20%;">Room</th>
                              <th style="width: 10%">Descuento</th>
                              <th style="width: 20%">Comprar</th>
                         </thead>
                         <tbody>
                              <?php foreach ($lista as $function){ 
                              if(strtotime($function->getStartDateTime())>strtotime(date("y-m-d H:i:s"))){?>
                              <tr>
                                   <td><?php echo $function->getStartDateTime();?></td>
                                   <td><?php echo $function->getRoom()->getCinema()->getName()?></td>
                                   <td><?php echo $function->getRoom()->getName()?></td>
                                   <td><?php
                                   $date = strtotime($function->getStartDateTime());
                                   if(date("l",$date) == "Tuesday" || date("l",$date) == "Wednesday")
                                        echo "25% off";?></td>
                                   <?php if(!isset($_SESSION["logged"])){
                                      echo "<td>Loguee para comprar</td>";  
                                   }else{?>
                                   <td><button type="submit" name="movieFunctionId" value="<?php echo $function->getMovieFunctionId()?>">Comprar</button></td>
                                   <?php } ?>
                              </tr>
                              <?php }} ?>
                              <?php echo '<img src="https://image.tmdb.org/t/p/w500'.$movie->getPoster().'" width="250" height="357">' ?>              
                         </tbody>
                    </table>
               </form>
          </div>
     </section>
</main>
<?php
echo '<form action="'.FRONT_ROOT.'Login/Index">
<button>Volver</button></form>';
?>
