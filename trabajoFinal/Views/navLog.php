<?php if(!isset($_SESSION['logged'])){?>
      <nav class=" nav-log navbar nav-nav navbar-expand-lg navbar-dark bg-primary d-flex justify-content-end fixed-top">
     <p> <?php $message ?> </p>
     <form class="form-nav-log" method="POST" action="<?php echo FRONT_ROOT.'Login/log';?>">
          <ul class="nav-log-ul">
               <li class="nav-log-li">
                    <input class ="nav-log-input" type="email" placeholder="Email" name="user_email" required>
               </li>
               <li class="nav-log-li" >
                    <input  class="nav-log-input" type="password" placeholder="Password" name="password" required>
               </li>
               <li class="nav-log-li" >
                    <button class="nav-log-button btn btn-danger float-right" type="submit">Ingresar</a>
               </li>
          </ul>
     </form>
     <form class="form-nav-log" action="<?php echo FRONT_ROOT.'Login/register'?>" method="post">
        <ul class="nav-log-ul">
              <li class="nav-log-li" >
                   <button class=" nav-log-button btn btn-danger float-right" type="submit">Registrarse</button>
              </li>
       </ul>
     </form>
 </nav><?php
 if($message == "Usuario y/o Contraseñia incorrectos"){ ?>
     <div class="alert alert-danger nav-login-alert">.
      <strong><?php echo $message;?></strong>
    </div>
  <?php } } sleep(8); $message=''; ?>
    

 
