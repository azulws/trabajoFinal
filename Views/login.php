<?php

if(isset($_SESSION['logged']))
{
    if($_SESSION['logged']->getRole()->getId()==1)
        include_once(VIEWS_PATH.'navAdmin.php');
    else
        include_once(VIEWS_PATH.'navUser.php');
}else{   
    include_once(VIEWS_PATH.'navLog.php');
    include_once(VIEWS_PATH."movieList.php");
}
?>
