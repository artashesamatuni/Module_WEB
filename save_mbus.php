<?php
require 'connection.php';
$conn    = Connect();

$sql = "DROP TABLE mbus_configs";

if ($conn->query($sql) != TRUE) {
    echo "ERR: " . $conn->error;
}

$sql = "CREATE TABLE mbus_configs (
enabled         TINYINT,
baud_rate       INT NOT NULL,
parity          TEXT NOT NULL,
stop_bits       TINYINT NOT NULL,
data_bits       TINYINT NOT NULL,
read_interval   INT NOT NULL,
read_timeout    INT NOT NULL
)";

if ($conn->query($sql) != TRUE) {
    echo "ERR: " . $conn->error;
}

echo $_POST['reg_type'];
$enabled        = $conn->real_escape_string($_POST['enabled']);
$baud_rate      = $conn->real_escape_string($_POST['baud_rate']);
$parity         = $conn->real_escape_string($_POST['parity']);
$stop_bits      = $conn->real_escape_string($_POST['stop_bits']);
$data_bits      = $conn->real_escape_string($_POST['data_bits']);
$read_interval  = $conn->real_escape_string($_POST['read_interval']);
$read_timeout   = $conn->real_escape_string($_POST['read_timeout']);



$sql = "INSERT INTO mbus_configs (enabled,baud_rate, parity, stop_bits,data_bits,read_interval,read_timeout)
VALUES ('".$enabled."','".$baud_rate."','".$parity."','".$stop_bits."','".$data_bits."','".$read_interval."','".$read_timeout."')";
if ($conn->query($sql) != TRUE) {
    echo "ERR: " . $sql . "<br>" . $conn->error;
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

$conn->close();
?>
