<?php
require '../connection.php';
$conn    = Connect();
if (isset($_POST['bit32'])) {
    $bit32=1;
} else {
    $bit32=0;
}
if (isset($_POST['ieee754'])) {
    $ieee754=1;
} else {
    $ieee754=0;
}
if (isset($_POST['low_first'])) {
    $low_first=1;
} else {
    $low_first=0;
}

$name       = $conn->real_escape_string($_POST['name']);
$dev_addr   = $conn->real_escape_string($_POST['dev_addr']);
$reg_addr   = $conn->real_escape_string($_POST['reg_addr']);
$reg_type   = $conn->real_escape_string($_POST['reg_type']);
$unit       = $conn->real_escape_string($_POST['unit']);
$slope      = $conn->real_escape_string($_POST['slope']);
$offset     = $conn->real_escape_string($_POST['offset']);



$query   = "INSERT INTO mbus_nods (name, dev_addr, reg_addr,reg_type,unit,slope,offset,bit32,ieee754,low_first )
VALUES ('".$name."','".$dev_addr."','".$reg_addr."','".$reg_type."','".$unit."','".$slope."','".$offset."','".$bit32."','".$ieee754."','".$low_first."')";


$success = $conn->query($query);

if (!$success) {
    die("Couldn't enter data: ".$conn->error);
} else {
    echo "Done!";
}


$conn->close();
