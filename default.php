<?php ob_start();
//sets title
$title = 'All Sport Sewing';
//adds header.php
require_once('header.php'); 
//gets selected page id and stores it
$id = $_GET['id']; 
$title_var = $_GET['title'];
try{
    //connect ot database
    require_once('database.php');
        //database query
        $sql = "SELECT * FROM `allsportpage` WHERE `page_id` = '$id'";
        $cmd = $conn->prepare($sql);
        $cmd->execute();
        $result = $cmd->fetchAll();
        //save database values to variables
    foreach ($result as $row) {
        $page_id = $row['page_id'];
        $page_title = $row['page_title'];
        $page = $row['page'];
    }//foreach
    //disconnect
    $conn = null;
}//try
catch (exception $e) {
        //mail myself
        mail('patr9240@gmail.com', 'Administration Default Error', $e);
        header('location:error.php');
        }//catch
//creates page from information on database
//if home links carousel in along with info from databse
if($id == '7')
    {
    echo
    '<div class = "jumbotron">
        <div class="container">
            <h1>' . $row['page_title'] . '</h1>
            <br>';
              require_once('carousel.php');
    echo'
            <br>
            <p>' . $page . '</p>
        </div>
    </div>';
}//if
//else just pulls info from database
else{
echo
    '<div class = "jumbotron">
        <div class="container">
            <h1>' . $row['page_title'] . '</h1>
            <br>
            <br>
            <p>' . $page . '</p>
        </div>
    </div>';
}//else
//adds footer.php
require_once('footer.php');
ob_flush(); ?>