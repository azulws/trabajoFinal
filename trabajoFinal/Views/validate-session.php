<?php 
//esto hay que ponerlo en positivo, cuando pongamos la variable $_SESSION['logged']== true cuando se loguee el usuario efectivamente
if(!isset($_SESSION['logged'])){
    header("location:../index.php");
}
?>