<?php ob_start();
//sets title
$title = 'All Sport Sewing';
//adds header.php
require_once('header.php'); ?>
<!--        login form-->
    <div class="container">
        <h1>Log In</h1>
        <form method="post" action="validate_login.php" class="form-horizontal">
<!--            email entry-->
            <div class="form-group">
                <label for="email" class="col-sm-2">Email: </label>
                <input name="email" required />
            </div>
                <br>
<!--            password entry-->
            <div class="form-group">
                <label for="password" class="col-sm-2">Password: </label>
                <input type="password" name="password" required />
            </div>
                <br>
<!--            Login button-->
            <div class="col-sm-offset-2">
                <input type="submit" value="Login!" class="btn btn-lg btn-success" />
            </div>
                <br>
        </form
    </div>
<?php
//adds footer.php
require_once('footer.php');
ob_flush(); ?>