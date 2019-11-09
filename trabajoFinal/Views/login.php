<?php
if(isset($_SESSION['logged']))
{
    /*echo 
    '<p>'.$message.'</p>'.
    '<form class="login" action="'.FRONT_ROOT.'Login/log" method="POST"> 
        <h2>Bienvenido</h2>
    <fieldset>
        <input type="email" class="email" placeholder="email" name="user_mail" required>
        <input type="password" class="password" placeholder="password" name="password" required>
    </fieldset>
         <button type="submit" name="action" value="Ingresar">Ingresar</button>'.
    '</form>';
     echo
    '<form class="login" action="'.FRONT_ROOT.'Login/register" method="POST"> 
        <button type="submit" name="action" value= "Registrar">Registrar</button>
    </form>';  */
    if($_SESSION['logged']->getRole()==1)
        include_once(VIEWS_PATH.'navAdmin.php');
    else
        include_once(VIEWS_PATH.'navUser.php');

}else{   
    /*echo 'Estas logeado con la cuenta de: '.$_SESSION['logged'];*/
    /*echo'<form class="login" action="'.FRONT_ROOT.'Login/logout" method="POST">'.
        '<button type="submit" name="action">Desconectar</button>'.
        '</form>';*/
    include_once(VIEWS_PATH.'navLog.php');
    include_once(VIEWS_PATH."movieList.php");
}
?>