<?php ob_start();
//sets title
$title = '404 Error';
//adds header.php
require_once('header.php'); ?>
<!--    404 error message-->
    <div class = "jumbotron">
        <div class="container">
            <h1>404 ERROR!</h1>
            <br>
            <h1>¯\_(ツ)_/¯</h1>
            <br>
            <h3>That page doesn't seem to exist, please try one of the links above.</h3>
            <br>
            <br>
        </div>
    </div>
<?php
//adds footer.php
require_once('footer.php');
ob_flush(); ?>