<?php ob_start(); 
//check if user is logged in
require_once('authenticate.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>Saving Administrator Changes</title>
    </head>
<!--    end of head-->
    <body>
        <?php
            try{
                //store inputs in variables
                $email = $_POST['email'];
                $name = $_POST['name'];
                $admin_id = $_POST['admin_id'];
                $ok = true;
                //validate variables
                //check email
                if (empty($email)) {
                    echo 'An email address is required. <br />';
                    $ok = false;
                }//if(emptyemail)
                //check name
                if (empty($name)) {
                    echo 'A name is required. <br />';
                    $ok = false;
                }//if(emptyname)
                if($ok){
                    //connect to database
                    require_once('database.php');
                    //check if email is already registered
                    $sql = "SELECT admin_id FROM admin WHERE admin_email = :email AND admin_id != :admin_id";
                    $cmd = $conn->prepare($sql);
                    $cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);
                    $cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
                    $cmd->execute();
                    $result = $cmd->fetchAll();
                    //if it is already registered, tells user to enter a new email
                    if (count($result) >= 1) {
                        echo 'That email is already registered, please enter a different one.';
                        $conn = null;
                    }//if(count)
                    //else saves registration variables to the database
                    else{
                        //insert variables into database
                        $sql = "UPDATE admin SET admin_name = :name, admin_email = :email WHERE admin_id = :admin_id";
                        $cmd = $conn->prepare($sql);
                        $cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);
                        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 50);
                        $cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
                        $cmd->execute();
                        //diconnect from database
                        $conn = null;
                        echo 'Administrator details changed successfully.';
                        header('location:admins.php');
                }//else
                }//if($ok)
            }//try
            catch (exception $e) {
            //mail myself
            mail('patr9240@gmail.com', 'Save Edit Admin Error', $e);
            header('location:error.php');
            }//catch
        ?>
    </body>
<!--    end of body-->
</html>
<?php ob_flush(); ?>