<?php ob_start(); 
//check if user is authenticated
require_once('authenticate.php');
?>
<!DOCTYPE html>
<html>
    <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>Saving Webpage</title>
    </head>
<!--    end of head-->
    <body>
        <?php
            try{
            //store inputs in variables
            $page_title = $_POST['title'];
            $page = $_POST['page'];
            $page_id = $_POST['page_id'];
            //connect to the database
            require_once('database.php');
            //if it's a new page create new page in database
            if (empty($page_id)) {
                //insert new page into database
                $sql = "INSERT INTO allsportpage (page_title, page) VALUES (:page_title, :page)";
            }//if(empty)
            //else update page in database
            else {
                $sql = "UPDATE allsportpage SET page_title = :page_title, page = :page WHERE page_id = :page_id";
            }//else
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':page_title', $page_title, PDO::PARAM_STR, 25);
            $cmd->bindParam(':page', $page, PDO::PARAM_STR);
            //fill the id parameter if updating
            if (!empty($page_id)) {
                $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
            }//if(!empty)
            $cmd->execute();
            //disconnect from database
            $conn = null;
            }//try
            catch (exception $e) {
            //mail myself
                mail('patr9240@gmail.com', 'Save Page Error', $e);
                header('location:error.php');
            }//catch
            echo "Page Saved";
            header('location:pages.php');
        ?>
    </body>
<!--    end of body-->
</html>
<?php ob_flush(); ?>
