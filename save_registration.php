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
                //store inputs in variables
                $email = $_POST['email'];
                $name = $_POST['name'];
                $password = $_POST['password'];
                $confirm = $_POST['confirm'];
                $ok = true;
                //validate variables
                //check email
                if (empty($email)) {
                    echo 'Your email address is required. <br />';
                    $ok = false;
                }//if email
                //check name
                if (empty($name)) {
                    echo 'Your name is required. <br />';
                    $ok = false;
                }//if name
                //check password
                if (empty($password)) {
                    echo 'A password is required. <br />';
                    $ok = false;
                }//if password
                //confirm password
                if ($password != $confirm) {
                    echo 'Your passwords don\'t match. <br />';
                    $ok = false;
                }//if confirm
                if($ok){
                    //connect to database
                    require_once('database.php');
                    //check if email is already registered
                    $sql = "SELECT admin_id FROM admin WHERE admin_email = :email";
                    $cmd = $conn->prepare($sql);
                    $cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);
                    $cmd->execute();
                    $result = $cmd->fetchAll();
                    //if it is already registered, tells user to enter a new email
                    if (count($result) >= 1) {
                        echo 'That email is already registered, please use a different one.';
                        $conn = null;
                    }//if(count)
                    //else saves registration variables to the database
                    else{
                        //hash the password
                        $password = hash('sha512', $password);
                        //insert variables into database
                        $sql = "INSERT INTO admin (admin_name, admin_email, password) VALUES (:name, :email, :password)";
                        $cmd = $conn->prepare($sql);
                        $cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);
                        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 50);
                        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);
                        $cmd->execute();
                        //email for funzies
                        mail($email, 'All Sport Sewing administrator registration.', 'You have successfully registered to All Sport Sewing.');
                        //diconnect from database
                        $conn = null;
                        echo 'Administrator added successfully. Click <a href="login.php">Here</a> to login.';
                }//else
                }//if($ok)
            }//try
            catch (exception $e) {
            //mail ourselves
            mail('patr9240@gmail.com', 'Save Registration Error', $e);
            header('location:error.php');
            }//catch
        ?>
    </body>
<!-- end of body-->
</html>
<?php ob_flush(); ?>