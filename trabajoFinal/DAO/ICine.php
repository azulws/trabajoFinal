<?php
    namespace DAO;

    interface ICine
    {
        function Add($cine);
        function Remove($nombre);
        function GetAll();
    }
?>