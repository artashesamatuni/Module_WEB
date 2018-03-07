<?php
require 'connection.php';
$conn    = Connect();

/*
    $sql = "DROP TABLE nods";

    if ($conn->query($sql) === TRUE) {
        echo "Table nods deleted successfully";
    } else {
        echo "Error deleting table: " . $conn->error;
    }

    $sql = "CREATE TABLE nods (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    dev_name VARCHAR(30) NOT NULL,
    dev_addr INT(3) NOT NULL,
    reg_addr INT(3) NOT NULL,
    reg_type ENUM('Coil','Discrete input','Holding register','Input register') NOT NULL,
    unit VARCHAR(12),
    slope FLOAT(8,5),
    offset FLOAT(8,5),
    bit32 tinyint(1),
    ieee754 tinyint(1),
    lwf tinyint(1)
    )";

    if ($conn->query($sql) === TRUE) {
        return "Table nods created successfully";
    } else {
        return "Error creating table: " . $conn->error;
    }
*/

echo $_POST['reg_type'];
$dev_name   = $conn->real_escape_string($_POST['dev_name']);
$dev_addr   = $conn->real_escape_string($_POST['dev_addr']);
$reg_addr   = $conn->real_escape_string($_POST['reg_addr']);
$reg_type   = $conn->real_escape_string($_POST['reg_type']);
$unit       = $conn->real_escape_string($_POST['unit']);
$slope      = $conn->real_escape_string($_POST['slope']);
$offset     = $conn->real_escape_string($_POST['offset']);
$bit32      = $conn->real_escape_string($_POST['bit32']);
$ieee754    = $conn->real_escape_string($_POST['ieee754']);
$lwf        = $conn->real_escape_string($_POST['lwf']);


$query   = "INSERT INTO nods (dev_name, dev_addr, reg_addr,reg_type,unit,slope,offset,bit32,ieee754,lwf)
VALUES ('".$dev_name."','".$dev_addr."','".$reg_addr."','".$reg_type."','".$unit."','".$slope."','".$offset."','".$bit32."','".$ieee754."','".$lwf."')";


$success = $conn->query($query);
 
if (!$success) {
    die("Couldn't enter data: ".$conn->error);
 
}
else
    echo "Done!";


$conn->close();
 
?>
