<?php
 
 
function Connect()
{
$servername = "localhost";
$username = "eaglemon";
$password = "eaglemon";
$dbname = "eaglemon";   
 

$conn = new mysqli($servername, $username, $password, $dbname) or die($conn->connect_error);
 
 return $conn;
}
 
?>
