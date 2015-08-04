<?php ob_start();
require_once('header.php');
?>
    <?php
        //name
$name = $_FILES['upload']['name'];
echo "Name: $name <br >";
    
        //size
$size = $_FILES['upload']['size'];
echo "Size: $size <br >";

        //type
$type = $_FILES['upload']['type'];
echo "Type: $type <br >";

        //get temp location
$tmp_name = $_FILES['upload']['tmp_name'];
echo "Tmp Name: $tmp_name <br >";

//save name as logo
session_start();
$name = "logo";

        //copy to location
move_uploaded_file($tmp_name, "uploads/$name");

        //if file is an image, display it
if (($type == "image/jpeg") || ($type == "image/png"))
{
 echo '<img src="uploads/' . $name . '">';   
}
?>
<?php
require_once('footer.php');
ob_flush();
?>