<?php ob_start();
//sets title
$title = 'Error';
//adds header.php
require_once('header.php'); ?>
<!--    general error message-->
    <div class = "jumbotron">
        <div class="container">
            <h1>ERROR!</h1>
            <br>
            <h1>¯\_(ツ)_/¯</h1>
            <br>
            <h3>Sorry! There seems to be an error with the website. Don't worry, our support team has already been notified and will get right on it!</h3>
            <br>
            <br>
        </div>
    </div>
<?php
//adds footer.php
require_once('footer.php');
ob_flush(); ?>