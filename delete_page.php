<?php ob_start(); 
//check if user is authenticated
require_once('authenticate.php');
?>
<!DOCTYPE html>
<html>
    <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    </head>
<!--    end of head-->
    <body>
        <?php
            try{
                //get the pages id
                $page_id = $_GET['page_id'];
                //connect
                require_once('database.php');
                //delete administrator credentials from the database
                $sql = "DELETE FROM allsportpage WHERE page_id = :page_id";
                $cmd = $conn->prepare($sql);
                $cmd->bindParam(':page_id', $page_id, PDO::PARAM_INT);
                $cmd->execute();
                //disconnect
                $conn = null;
                //send user to new administrators page
                header('location:pages.php');
            }//try
            catch (exception $e) {
            //mail ourselves
            mail('patr9240@gmail.com', 'Delete page Error', $e);
            header('location:error.php');
            }//catch
        ?>
    </body>
<!--    end of body-->
</html>
<?php ob_flush(); ?>