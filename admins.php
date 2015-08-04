<?php ob_start();
//check if user is authenticated
require_once('authenticate.php');
//sets title
$title = 'All Sport Sewing Control Panel';
//adds header.php
require_once('header.php'); 
 ?>
<div class="container">
<h1>Administrators</h1>
    <?php
        try{
            //connect to database
            require_once('database.php');
            //sql select command and query
            $sql = "SELECT * FROM admin";
            $cmd = $conn->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll();
            //create administrators table
            echo '<table class="table table-bordered">
                <thread>
                    <th>Administrator ID</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thread>
            <tbody>';
            //enter records from the database into the table
            foreach ($result as $row) {
                echo '<tr>
                    <td>' . $row['admin_id'] . '</td>
                    <td>' . $row['admin_name'] . '</td>
                    <td>' . $row['admin_email'] . '</td>
                    <td><a href="edit_admin.php?admin_id=' . $row['admin_id'] . '">Edit</a></td>
                    <td><a href="delete_admin.php?admin_id=' . $row['admin_id'] . '"onclick="return confirm(\'Are you sure you want to delete this administrator?\');">Delete</a></td>
                </tr>';
            }//foreach
            //end table
            echo '</tbody></table>';
            //disconnect from database
            $conn = null;
        }//try
        catch (exception $e) {
        //mail myself
        mail('patr9240@gmail.com', 'Administration Table Error', $e);
        header('location:error.php');
        }//catch
?>
</div>
<?php
//adds footer.php
require_once('footer.php');
ob_flush(); ?>