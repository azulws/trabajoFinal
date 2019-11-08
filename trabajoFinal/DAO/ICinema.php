<?php
    namespace DAO;

    interface ICinema
    {
        function Add(Cinema $cinema);
        function Remove($id);
        function GetAll();
    }
?>