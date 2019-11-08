<?php
    namespace DAO;

    interface IUser
    {
        function Add(User $user);
        function Remove($id);
        function GetAll();
    }
?>