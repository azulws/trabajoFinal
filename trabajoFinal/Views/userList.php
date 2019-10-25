<?php
if($lista==false){
	echo '<script>alert("No hay usuarios base de datos");</script>';
}else{
	foreach($lista as $user){
        if($user->getRol()!=1){
            echo '<dl>'.
                        '<dt> email: '.$user->getEmail().'<dt>'.
                        '<dd> name: '.$user->getName().'</dd>'.
                        '<dd> lastname: '.$user->getLastName().'</dd>'.
                        '<dd> DNI: '.$user->getDni().'</dd>'.
                        '<form action="'.FRONT_ROOT.'Login/RemoveDB">
                                <button name="email" value="'.$user->getEmail().'">Eliminar</button>
                        </form>'. //TODO verificar si update cambia el valor a 1
	                '<form action="'.FRONT_ROOT.'Login/UpdateToAdminDB">
                                <button name="name" value="'.$user->getEmail().'">Change</button>
                        </form>'.
                '</dl>';	
        }
	}
}
echo '<form action="'.FRONT_ROOT.'Login/homeAdmin">
<button>Volver</button></form>';
?>
