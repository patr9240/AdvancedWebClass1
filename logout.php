<?php 
    ob_start();
    session_start();
    //remove session variables
    session_unset();
    //remove users session
    session_destroy();
    //redirect to login
    header('location:default.php?id=7');
    exit();
    ob_flush(); 
?>