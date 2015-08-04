<?php ob_start();
//sets title
$title = 'All Sport Sewing';
//adds header.php
require_once('header.php'); ?>
<!--    Registration form-->
    <div class="container">
        <h1>Administrator Registration</h1>
        <form method="post" action="save_registration.php" class="form-horizontal">
                <br>
<!--            email input-->
            <div class="form-group">
                <label for="email" class="col-sm-2">Email Address: </label>
                <input type="email" name="email" required />
            </div>
                <br>
<!--            name input-->
            <div class="form-group">
                <label for="name" class="col-sm-2">Full Name: </label>
                <input name="name" required />
            </div>
                <br>
<!--            password input-->
            <div class="form-group">
                <label for="password" class="col-sm-2">Password: </label>
                <input type="password" name="password" required />
            </div>
                <br>
<!--            confirm password input-->
            <div class="form-group">
                <label for="confirm" class="col-sm-2">Confirm Password:</label>
                <input type="password" name="confirm" required />
            </div>
                <br>
<!--            registration button-->
            <div class="col-sm-offset-2">
                <input type="submit" value="Register!" class="btn btn-lg btn-success" />
            </div>
                <br>
        </form>
    </div>
<?php
//adds footer.php
require_once('footer.php');
ob_flush(); ?>