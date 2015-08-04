<?php ob_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    </head>
<!-- end of head-->
    <body>
        <?php
            try{
                //store input variables
                $email = $_POST['email'];
                $password = hash('sha512', $_POST['password']);
                //connect to database
                require_once('database.php');
                //validate login inputs
                $sql = "SELECT admin_id FROM admin WHERE admin_email = :email AND password = :password";
                $cmd = $conn->prepare($sql);
                $cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);
                $cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);
                $cmd->execute();
                $result = $cmd->fetchAll();
                //if valid credentials, stores the admin_id in the session
                if (count($result) >=1) {
                    echo 'You have logged in successfully.';
                    session_start();
                    foreach ($result as $row){
                     $_SESSION['admin_id']=$row['admin_id'];   
                    }//foreach
                    header('location:admins.php');
                }//if
                //else fails login attempt
                else {
                    echo 'The login information you have entered is not valid.';
                }//else
                $conn = null;
            }//try
            catch (exception $e) {
            //mail ourselves
            mail('patr9240@gmail.com', 'Validate Login Error', $e);
            header('location:error.php');
            }//catch
        ?>
    </body>
<!-- end of body-->
</html>
<?php ob_flush();?>