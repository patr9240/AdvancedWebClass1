<?php
//connect to DB
$conn = new PDO('mysql:host=xxx.xxxxxx.xxx;dbname=xxxxxxx', 'xxxxxxxx', 'xxxxxxx');
//error handling
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>