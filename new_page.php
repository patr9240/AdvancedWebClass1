<?php ob_start();
require_once('authenticate.php');
//sets title
$title = 'Add Webpage';
//adds header.php
require_once('header.php'); ?>
<!--Tinymce text area JS -->
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
    <div class="container">
        <h1>Webpage Creation</h1>
            <form method="post" action="save_page.php" class="form-horizontal">
                    <br>
    <!--            page title input-->
                <div class="form-group">
                    <label for="title" class="col-sm-2">Page Title: </label>
                    <input name="title" required />
                </div>
                    <br>
    <!--            page content input-->
                <div class="form-group">
                    <label for="page">Page Content: </label>
                    <textarea name="page" class="form-control" rows="15"></textarea>
                </div>
                    <br>
    <!--            save page button-->
                <div class="col-sm-offset-2">
                    <input type="submit" value="Create Page!" class="btn btn-lg btn-success" />
                </div>
                    <br>
            </form>
    </div>
<?php
//adds footer.php
require_once('footer.php');
ob_flush(); ?>