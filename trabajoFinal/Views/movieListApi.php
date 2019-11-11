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
               <h2 class="mb-4">Listado de Peliculas de API</h2>
               <form action="<?php echo FRONT_ROOT.'Movie/add'; ?>" method="POST">
                    <table class="table bg-light">
                         <thead class="bg-dark text-white">
                              <th>Title</th>
                              <th>Description</th>
                              <th>Genres</th>
                              <th></th>
                              <th>Agregar</th>
                         </thead>
                         <tbody>
                         <?php if($lista!=false)foreach($lista as $movie) { ?>
                              <tr>
                                   <td><?php echo $movie->getTitle() ?></td>
                                   <td><?php echo $movie->getDescription() ?></td>
                                   <td><?php foreach ($movie->getGenres() as $genre) echo $genre->getDescription()." \n";?></td>
                                   <td><?php echo '<img src="https://image.tmdb.org/t/p/w500'.$movie->getPoster().'" width="250" height="357">' ?></td>
                                   <td><button type="submit" name="id" value="<?php echo $movie->getId()?>"> Agregar </button></td>
                              </tr>
                         <?php } ?>                        
                         </tbody>
                    </table>
               </form>
          </div>
     </section>
</main>
<?php if(isset($_SESSION['pageNumber']) && $_SESSION['pageNumber']>1)
      {
        echo "<form action = ".FRONT_ROOT."Movie/prevPage method = 'POST'>
                <button type=submit> Página Anterior </button>
              </form>";
      }
      echo "<label class = 'bg-dark text-white'><p>Page: ".$_SESSION['pageNumber']."</p></label>";
      if(isset($_SESSION['pageNumber']))
      {
        echo "<form action = ".FRONT_ROOT."Movie/nextPage method = 'POST'>
                <button type=submit> Página siguiente </button>
              </form>";
      }?>
<?php include('footer.php') ?>
