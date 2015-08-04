<?php
    //checks if user is logged in
    session_start();
    if(empty($_SESSION['admin_id'])){
        header('location:login.php');
        exit();
    }//if
?>