<?php
include_once(VIEWS_PATH.'login.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Peliculas</h2>
               <form method="POST">
                    <table class="table bg-light">
                         <thead class="bg-dark text-white">
                              <th>Title</th>
                              <th>Description</th>
                              <th>Runtime</th>
                              <th>Genres</th>
                              <th></th>
                         </thead>
                         <tbody>
                         <?php foreach($lista as $movie) { ?>
                              <tr>
                                   <td><?php echo $movie->getTitle() ?></td>
                                   <td><?php echo $movie->getDescription() ?></td>
                                   <td><?php echo $movie->getRuntime() ?></td>
                                   <td><?php foreach($movie->getGenres() as $genre) echo "** ".$genre->getDescription()." **";?></td>
                                   <td><?php echo '<img src="https://image.tmdb.org/t/p/w500'.$movie->getPoster().'" width="250" height="357">' ?></td>
                              </tr>
                         <?php } ?>                        
                         </tbody>
                    </table>
                    
               </form>
          </div>
     </section>
</main>

<?php include('footer.php') ?>
