<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Funciones de <?php echo $movie->getTitle()?></h2>
               <form action="<?php echo FRONT_ROOT."Buyout/countTicketsForm"?>" method="POST">
                    <table class="table bg-light">
                         <thead class="bg-dark text-white">
                              <th style="width: 20%;">Horarios</th>
                              <th style="width: 30%;">Cine</th>
                              <th style="width: 10%">Descuento</th>
                              <th style="width: 20%">Comprar</th>
                         </thead>
                         <tbody>
                              <?php foreach ($lista as $function){ ?>
                              <tr>
                                   <td><?php echo $function->getStartDateTime();?></td>
                                   <td><?php echo $function->getCinema()->getName()?></td>
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
                              <?php } ?>
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
<?php include('footer.php') ?>