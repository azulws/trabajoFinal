<?php
if(isset($message) && $message!=""){
     echo '<script type="text/javascript">';
     echo ' alert("'.$message.'")'; 
     echo '</script>';
}?>
<div class= "nav-log">
<nav class="d-flex justify-content-end nav-nav">
  <a class="nav-link">Bienvenido <?php echo $_SESSION['logged']->getName()?></a>
  <a class="nav-link" href="<?php echo FRONT_ROOT.'MovieFunction/listMovieFunctionListDB'?>">Peliculas</a>
  <a class="nav-link" href="<?php echo FRONT_ROOT.'Ticket/showTicketListByUser'?>">VerCompras</a>
  <a class="nav-link" href="<?php echo FRONT_ROOT.'CreditCard/showCreditCardList'?>">Tarjetas</a>
<a class="nav-link" href="<?php echo FRONT_ROOT.'Login/logout'?>">Desconectarse</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</nav>
</div>
