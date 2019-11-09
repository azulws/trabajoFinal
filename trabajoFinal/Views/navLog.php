<div id= "nav">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary d-flex justify-content-end">
     <p> <?php $message ?> </p>
     <form class="form-nav-log" method="POST" action=<?php echo FRONT_ROOT.'Login/log';?>>
          <ul class="nav justify-content-center ml-auto">
               <li class="nav-item"  >
                    <input class ="inputs" type="email" placeholder="Email" name="user_email" required>
               </li>
               <li class="nav-item" >
                    <input  type="inputs" type="password" placeholder="Password" name="password" required>
               </li>
               <li class="nav-item" >
                    <button class="buttons btn btn-danger float-right" type="submit">Ingresar</a>
               </li>
          </ul>
     </form>
     <form class="form-nav-log" action=<?php echo FRONT_ROOT.'Login/register'?>>
        <ul class="nav justify-content-center ml-auto">
              <li class="nav-item" >
                   <button class=" buttons btn btn-danger float-right" type="submit">Registrarse</button>
              </li>
       </ul>
     </form>
</nav>
<div id="nav">

    