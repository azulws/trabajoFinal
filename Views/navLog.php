<?php
if(isset($message) && $message!=""){
     echo '<script type="text/javascript">';
     echo ' alert("'.$message.'")'; 
     echo '</script>';
   }
?>
<div class= "nav-log">
 <nav class="d-flex justify-content-end">
     <p> <?php $message ?> </p>
     <form class="form-nav-log" method="POST" action="<?php echo FRONT_ROOT.'Login/log';?>">
          <ul class="nav-log-ul">
               <li class="nav-log-li"  >
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
        <ul class="nav-log-ul ">
              <li class="nav-log-li" >
                   <button class=" nav-log-button btn btn-danger float-right" type="submit">Registrarse</button>
              </li>
       </ul>
     </form>
 </nav>
</div>

    