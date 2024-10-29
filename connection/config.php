<?php
$server = "localhost";
$user = "root";
$password = "";
$database_name ="monrist";

$dbConnection = new mysqli($server,$user,$password,$database_name);
if($dbConnection->connect_error)
{
    die("Connection to Database Failed! :". $dbConnection->connect_error);
}
//echo '<script>alert("Connected to Database!")</script>'
?>
