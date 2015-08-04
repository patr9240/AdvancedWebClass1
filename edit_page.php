<?php ob_start();
//sets title
$title = 'All Sport Sewing Control Panel';
require_once('authenticate.php');
//adds header.php
require_once('header.php');
?>
<!--Tinymce text area JS -->
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
    <?php
        try {
            //check for page ID and store it's value in a variable
            if(!empty($_GET['page_id'])) {
                $page_id = $_GET['page_id'];

            //connect to database
            require_once('database.php');
            //select and retrieve page data from the database
            $sql = "SELECT * FROM allsportpage WHERE page_id = :page_id";
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetchAll();
            //store values form the database in variables
            foreach ($result as $row) {
                $page_title = $row['page_title'];
                $page = $row['page'];
                $page_id = $row['page_id'];
            }//foreach
            //disconnect from database
            $conn = null;
            }//if
        }//try
        catch (exception $e) {
        //mail ourselves
        mail('patr9240@gmail.com', 'Edit Page Error', $e);
        header('location:error.php');
        }//catch
    ?>
<!--        edit webpage-->
        <div class="container">
            <h1>Edit Webpage</h1>
                <br>
            <form method="post" action="save_page.php" class="form-horizontal">
                    <br>
<!--            page title edit-->
                <div class="form-group">
                    <label for="title" class="col-sm-2">Page Title: </label>
                    <input name="title" required value="<?php echo $page_title; ?>" />
                </div>
                    <br>
 <!--            page content edit-->
                <div class="form-group">
                    <label for="page">Page Content: </label>
                    <textarea name="page" class="form-control" rows="15"><?php echo $page; ?></textarea>
                </div>
                    <br>
<!--                hidden page id, no changing!-->
                    <input type="hidden" name="page_id" value="<?php echo $page_id; ?>" />
<!--                save button-->
                <div class="col-sm-offset-3">
                    <input type="submit" value="Save Changes!" class="btn btn-lg btn-success" />
                </div>
                    <br>
            </form>
        </div>
<?php
//adds footer.php
require_once('footer.php');
ob_flush(); ?>