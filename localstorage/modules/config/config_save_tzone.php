<?php
require '../connection.php';
$conn = Connect();
$timezone = $conn->real_escape_string($_POST['timezone']);

$sql = "UPDATE timezone SET timezone ='".$timezone."'";
if ($conn->query($sql) != true) {
    echo "ERR: " . $sql . "<br>" . $conn->error;
} else {
    date_default_timezone_set($timezone);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$conn->close();
?>
