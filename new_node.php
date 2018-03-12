<?php
require 'connection.php';
$conn    = Connect();

$name       = $conn->real_escape_string($_POST['name']);
$dev_addr   = $conn->real_escape_string($_POST['dev_addr']);
$reg_addr   = $conn->real_escape_string($_POST['reg_addr']);
$reg_type   = $conn->real_escape_string($_POST['reg_type']);
$unit       = $conn->real_escape_string($_POST['unit']);
$slope      = $conn->real_escape_string($_POST['slope']);
$offset     = $conn->real_escape_string($_POST['offset']);
$bit32      = $conn->real_escape_string($_POST['bit32']);
$ieee754    = $conn->real_escape_string($_POST['ieee754']);
$low_first  = $conn->real_escape_string($_POST['low_first']);


$query   = "INSERT INTO mbus_nods (name, dev_addr, reg_addr,reg_type,unit,slope,offset,bit32,ieee754,low_first )
VALUES ('".$name."','".$dev_addr."','".$reg_addr."','".$reg_type."','".$unit."','".$slope."','".$offset."','".$bit32."','".$ieee754."','".$low_first."')";


$success = $conn->query($query);

if (!$success) {
    die("Couldn't enter data: ".$conn->error);

}
else
    echo "Done!";


$conn->close();





?>
