<?php
if($message!=""){
    echo '<script type="text/javascript">';
    echo ' alert("'.$message.'")'; 
    echo '</script>';
}
if(isset($_SESSION['logged']))
{
    if($_SESSION['logged']->getRole()==1)
        include_once(VIEWS_PATH.'navAdmin.php');
    else
        include_once(VIEWS_PATH.'navUser.php');
}else{   
    include_once(VIEWS_PATH.'navLog.php');
    include_once(VIEWS_PATH."movieList.php");
}
?>