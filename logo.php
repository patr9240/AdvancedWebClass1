<?php ob_start();
//adds header
require_once('header.php');
?>
<div class="container">
<form method="post" action="save_logo.php" enctype="multipart/form-data">
<div>
    <label for="upload">Pick an image.</label>
    <br>
    <br>
<!--    upload button-->
    <input type="file" name="upload" class="btn btn-lg btn-success">
    <br>
    <p>Note: all logo's are scaled to 225x62 pixels, contact admin if you need assistance.</p>
    <br>
    </div>
<!--    submit button-->
    <input type="submit" value="Submit" class="btn btn-lg btn-success">
    <br>
    <br>
    </form>
</div>
<?php
//adds footer
require_once('footer.php');
ob_flush();
?>