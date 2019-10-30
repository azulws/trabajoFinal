<?php
    namespace DAO;

    interface ICinema
    {
        function Add($cinema);
        function Remove($name);
        function GetAll();
    }
?>