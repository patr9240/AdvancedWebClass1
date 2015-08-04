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
                //get the administrators id
                $admin_id = $_GET['admin_id'];
                //connect
                require_once('database.php');
                //delete administrator credentials from the database
                $sql = "DELETE FROM admin WHERE admin_id = :admin_id";
                $cmd = $conn->prepare($sql);
                $cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
                $cmd->execute();
                //disconnect
                $conn = null;
                //send user to new administrators page
                header('location:admins.php');
            }//try
            catch (exception $e) {
            //mail ourselves
            mail('patr9240@gmail.com', 'Delete Admin Error', $e);
            header('location:error.php');
            }//catch
        ?>
    </body>
<!--    end of body-->
</html>
<?php ob_flush(); ?>