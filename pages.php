<?php ob_start();
//check if user is authenticated
require_once('authenticate.php');
//sets title
$title = 'All Sport Sewing Control Panel';
//adds header.php
require_once('header.php'); ?>
<div class="container">
<h1>Webpages</h1>
        <br>
        <?php
            try{
                //connect to database
                require_once('database.php');
                //sql select command and query
                $sql = "SELECT * FROM allsportpage";
                $cmd = $conn->prepare($sql);
                $cmd->execute();
                $result = $cmd->fetchAll();
                //create webpage table
                echo '<table class="table table-bordered">
                    <thread>
                        <th>Page ID</th>
                        <th>Page Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thread>
                <tbody>';
                //enter records from the database into the table
                foreach ($result as $row) {
                    echo '<tr>
                        <td>' . $row['page_id'] . '</td>
                        <td>' . $row['page_title'] . '</td>
                        <td><a href="edit_page.php?page_id=' . $row['page_id'] . '">Edit</a></td>
                        <td><a href="delete_page.php?page_id=' . $row['page_id'] . '"onclick="return confirm(\'Are you sure you want to delete this page?\');">Delete</a></td>
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
            <br>
<!--        save new page button-->
        <div class="col-sm-offset-2">
            <a href="new_page.php"><input type="button" value="Create new page!" class="btn btn-lg btn-success" /></a>
        </div>
            <br>
    </div>
<?php
//adds footer.php
require_once('footer.php');
ob_flush(); ?>