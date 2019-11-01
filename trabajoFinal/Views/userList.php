<?php
if($lista==false){
	echo '<script>alert("No hay usuarios base de datos");</script>';
}else{
        echo "<h2>Usuarios</h2>";
        $i = 0;
	foreach($lista as $user){
                if($user->getRole()==2){
                echo '<dl>'.
                        '<dt> email: '.$user->getEmail().'<dt>'.
                        '<dd> name: '.$user->getName().'</dd>'.
                        '<dd> lastname: '.$user->getLastName().'</dd>'.
                        '<dd> DNI: '.$user->getDni().'</dd>'.
                        '<form action="'.FRONT_ROOT.'Login/RemoveDB">
                                <button name="email" value="'.$user->getEmail().'">Eliminar</button>
                        </form>'.
	                '<form action="'.FRONT_ROOT.'Login/UpdateRoleDB">
                                <button name="name" value="'.$user->getEmail().'">Change</button>
                        </form>'.
                '</dl>';
                $i++;	
                }
        }
        if($i==0){
                echo "NO HAY USUARIOS CARGADOS";
        }
        echo "<h2>Admin</h2>";
        $i = 0;
        foreach($lista as $user){
        if($user->getRole()==1){
                echo '<dl>'.
                        '<dt> email: '.$user->getEmail().'<dt>'.
                        '<dd> name: '.$user->getName().'</dd>'.
                        '<dd> lastname: '.$user->getLastName().'</dd>'.
                        '<dd> DNI: '.$user->getDni().'</dd>'.
                        '<form action="'.FRONT_ROOT.'Login/RemoveDB">
                                <button name="email" value="'.$user->getEmail().'">Eliminar</button>
                        </form>'.
                        '<form action="'.FRONT_ROOT.'Login/UpdateRoleDB">
                                <button name="name" value="'.$user->getEmail().'">Change</button>
                        </form>'.
                '</dl>';	
                $i++;	
                }
                
        }
        if($i==0){
                echo "NO HAY ADMINISTRADORES CARGADOS";
        }
}
echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
<button>Volver</button></form>';
?>
