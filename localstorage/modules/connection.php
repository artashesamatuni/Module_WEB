<?php
include 'settings.php';

function Connect()
{
    global $servername;
    global $dbusername;
    global $dbpassword;
    global $dbname;
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname) or die($conn->connect_error);
    return $conn;
}
?>
