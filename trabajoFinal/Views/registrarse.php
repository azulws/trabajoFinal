
   <div class="container">        
   <div class="row justify-content-center"> 
   <form class="form-register " method="POST" action="<?php echo FRONT_ROOT.'Login/createUserDB';?>">
    
     <h2 class="form-register-title">Registro de usuario</h2>

     <ul class="form-register-ul bg-primary"> 
        <li class="form-register-li">
            <input class="form-register-input" type="text" name="name" placeholder="Name" required>
        </li>
        <li class="form-register-li">
            <input class="form-register-input" type="text" name="lastname" placeholder="Lastname" required>
        </li>
        <li class="form-register-li">
             <input class="form-register-input" type="email" name="email" placeholder="Email" required>
        </li>
         <li class="form-register-li">            
             <input class="form-register-input" type="password" name="password" placeholder="Contraseña" required>
        </li>
         <li class="form-register-li">
            <input class="form-register-input" type="number" name="dni" placeholder="dni" required min=1000000>
        </li>
        <li class="form-register-li">
            <button class="form-register-buttons btn btn-danger" type="submit" name="register">Registrarse</button>
        </li>
        </ul>
        </form> 
    </div>
    <div class="row justify-content-center">
    <form class="form-register" action="<?php echo FRONT_ROOT.'Login/Index';?>" method='POST'>
     <ul class="form-register-ul">
         <li class="form-register-li">
             <button class="form-register-buttons btn btn-danger" type='submit' name='action'>Volver</button>
         </li>
     </ul>
    </form>
    </div>
   </div>

