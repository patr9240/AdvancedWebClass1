<!DOCTYPE html>
<html>

    <head>
        
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>
        
<!--        CSS from Bootstrap -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
            <link rel="stylesheet" href="stylesheet/stylesheet.css">
    </head>
<!--        end of head-->
    <body>
<!--        navbar-->
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
<!--                logo image-->
                <a class="navbar-brand" href="default.php"><img alt="Brand" src="uploads/logo" width="225" height="62"></a>
                <ul class="nav navbar-nav">
                    <?php
                    try{
                    session_start();
                    //checks if user is logged in if they are, show admin nav bar
                    if(!empty($_SESSION['admin_id'])){
                        echo   
                        '<li><a href="admins.php">Administrators</a></li>
                        <li><a href="pages.php">Pages</a></li>
                        <li><a href="logo.php">Logo</a></li>
                        <li><a href="logout.php">Public Site</a></li>
                        <li><a href="logout.php">Log Out</a></li>';
                    }//if
                    //else show regular nav bar
                    else{
                        require_once('database.php');
                        $sql = "SELECT page_title, page_id FROM allsportpage";
                            //execute the query
                            $cmd = $conn->prepare($sql);
                            $cmd->execute();
                            $result = $cmd->fetchAll();
                            foreach($result as $row){
                                echo
                                    '<li><a title="'  . $row['page_title'] . '" href="default.php?id=' . $row['page_id'] . '">' . $row['page_title'] . '</a></li>';
                            }//foreach
                            echo 
                                '<li><a href="register.php">Register</a></li>
                            <li><a href="login.php">Login</a></li>';
                    }//else
                    }//try
                    catch (exception $e) {
                    //mail myself
                    mail('patr9240@gmail.com', 'Header Error', $e);
                    header('location:error.php');
                    }//catch
                    ?>
                </ul>
            </div>
          </div>
        </nav>
