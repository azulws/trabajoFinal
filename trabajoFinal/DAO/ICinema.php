<?php
    namespace DAO;

    interface ICinema
    {
        function Add($cinema);
        function Remove($nombre);
        function GetAll();
    }
?>