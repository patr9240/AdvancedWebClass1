<?php ob_start();
//sets title
$title = 'All Sport Sewing Control Panel';
require_once('authenticate.php');
//adds header.php
require_once('header.php');
?>
    <?php
        try {
            //check for admin ID and store it's value in a variable
            if(!empty($_GET['admin_id'])) {
                $admin_id = $_GET['admin_id'];

            //connect to database
            require_once('database.php');
            //select and retrieve admin data from the database
            $sql = "SELECT * FROM admin WHERE admin_id = :admin_id";
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
            $cmd->execute();
            $result = $cmd->fetchAll();
            //store values form the database in variables
            foreach ($result as $row) {
                $email = $row['admin_email'];
                $name = $row['admin_name'];
                $admin_id = $row['admin_id'];
            }//foreach
            //disconnect from database
            $conn = null;
            }//if
        }///try
        catch (exception $e) {
        //mail ourselves
        mail('patr9240@gmail.com', 'Student Error', $e);
        header('location:error.php');
        }//catch
    ?>
<!--        edit admin form-->
        <div class="container">
            <h1>Edit Administrator</h1>
                <br>
            <?php echo '<b>Administrator ID: ' . $admin_id . '</b>'; ?>
            <form method="post" action="save_edit_admin.php" class="form-horizontal">
                    <br>
<!--                edit admin email-->
                <div class="form-group">
                    <label for="email" class="col-sm-3">Email: </label>
                    <input name="email" required value="<?php echo $email; ?>" />
                </div>
                    <br>
<!--                edit admin name-->
                <div class="form-group">
                    <label for="name" class="col-sm-3">Name: </label>
                    <input name="name" required value="<?php echo $name; ?>" />
                </div>
                    <br>
<!--                hidden admin id, no changing!-->
                    <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>" />
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