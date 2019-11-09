<nav class="navbar navbar-expand-lg navbar-dark bg-primary d-flex justify-content-end">
     <p> <?php $message ?> </p>
     <form method="POST" action=<?php echo FRONT_ROOT.'Login/log';?>>
          <ul class="nav justify-content-center ml-auto">
               <li class="nav-item">
                    <input class ="type="email" placeholder="Email" name="user_email" required>
               </li>
               <li class="nav-item">
                    <input type="password" placeholder="Password" name="password" required>
               </li>
               <li class="nav-item">
                    <button class="btn btn-danger float-right" type="submit">Ingresar</a>
               </li>
          </ul>
     </form>
     <form action=<?php echo FRONT_ROOT.'Login/register'?>>
          <button class="btn btn-danger float-right" type="submit">Registrarse</button>
     </form>
</nav>

    