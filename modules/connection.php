<?php
include('settings.php');

function Connect()
{
    global $servername;
    global $username;
    global $password;
    global $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname) or die($conn->connect_error);
    return $conn;
}
?>
