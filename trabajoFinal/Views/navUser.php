<?php
if(isset($message) && $message!=""){
     echo '<script type="text/javascript">';
     echo ' alert("'.$message.'")'; 
     echo '</script>';
}?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary d-flex justify-content-end">
  <a class="navbar-brand">Bienvenido <?php echo $_SESSION['logged']->getName()?></a>
  <a class="navbar-brand" href="<?php echo FRONT_ROOT.'MovieFunction/listMovieFunctionListDB'?>">Peliculas</a>
  <a class="navbar-brand" href="<?php echo FRONT_ROOT.'Ticket/showTicketListByUser'?>">VerCompras</a>
  <a class="navbar-brand" href="<?php echo FRONT_ROOT.'CreditCard/showCreditCardList'?>">Tarjetas</a>
<a class="navbar-brand" href="<?php echo FRONT_ROOT.'Login/logout'?>">Desconectarse</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
<br>
<br>
