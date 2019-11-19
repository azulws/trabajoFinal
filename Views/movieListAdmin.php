<?php
include_once(VIEWS_PATH.'login.php');
if($message!=""){
     echo '<script type="text/javascript">';
     echo ' alert("'.$message.'")'; 
     echo '</script>';
   }
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Peliculas en BD</h2>
               <form method="POST">
                    <table class="table bg-light">
                         <thead class="bg-dark text-white">
                              <th>Title</th>
                              <th>Description</th>
                              <th>Runtime (mins)</th>
                              <th>Genres</th>
                              <th></th>
                         </thead>
                         <tbody>
                         <?php if($lista!=false)foreach($lista as $movie) { ?>
                              <tr>
                                   <td><?php echo $movie->getTitle() ?></td>
                                   <td><?php echo $movie->getDescription() ?></td>
                                   <td><?php echo $movie->getRuntime() ?></td>
                                   <td><?php foreach ($movie->getGenres() as $genre) echo $genre->getDescription()." \n";?></td>
                                   <td><?php echo '<img src="https://image.tmdb.org/t/p/w500'.$movie->getPoster().'" width="250" height="357">' ?></td>
                              </tr>
                         <?php } ?>                        
                         </tbody>
                    </table>
                    
               </form>
          </div>
     </section>
</main>

