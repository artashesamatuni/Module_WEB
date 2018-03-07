<?php
require 'connection.php';
$conn    = Connect();

$sql = "DROP TABLE mbus";

if ($conn->query($sql) === TRUE) {
    echo "OK";
} else {
    echo "ERR: " . $conn->error;
}

$sql = "CREATE TABLE mbus (
baud_rate       ENUM('4800','9600','19200','38400','57600','115200','128000') NOT NULL,
parity          ENUM('even','odd','null') NOT NULL,
stop_bits       ENUM('1','2') NOT NULL,
data_bits       ENUM('7','8') NOT NULL,
read_interval   INT(16) NOT NULL,
read_timeout    INT(16) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "OK";
} else {
    echo "ERR: " . $conn->error;
}

echo $_POST['reg_type'];
$baud_rate      = $conn->real_escape_string($_POST['baud_rate']);
$parity         = $conn->real_escape_string($_POST['parity']);
$stop_bits      = $conn->real_escape_string($_POST['stop_bits']);
$data_bits      = $conn->real_escape_string($_POST['data_bits']);
$read_interval  = $conn->real_escape_string($_POST['read_interval']);
$read_timeout   = $conn->real_escape_string($_POST['read_timeout']);



$sql = "INSERT INTO mbus (baud_rate, parity, stop_bits,data_bits,read_interval,read_timeout)
VALUES ('".$baud_rate."','".$parity."','".$stop_bits."','".$data_bits."','".$read_interval."','".$read_timeout."')";
if ($conn->query($sql) === TRUE) {
    echo "OK";
} else {
    echo "ERR: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
