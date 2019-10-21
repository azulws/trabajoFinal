<?php
    namespace DAO;

    interface IUser
    {
        function Add($user);
        function Remove($email);
        function GetAll();
    }
?>