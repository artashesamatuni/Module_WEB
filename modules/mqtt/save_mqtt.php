<?php
require 'connection.php';
$conn    = Connect();

$sql = "DROP TABLE mqtt_configs";

if ($conn->query($sql) != TRUE) {
    echo "ERR: " . $conn->error;
}

$sql = "CREATE TABLE mqtt_configs (
    enabled TINYINT,
    srv_addr TEXT,
    srv_port SMALLINT,
    base_topic TEXT,
    crt_enabled TINYINT,
    username TEXT,
    password TEXT,
    read_interval SMALLINT,
    crt_name TEXT,
    key_name TEXT,
    ca_name TEXT
)";

if ($conn->query($sql) != TRUE) {
    echo "ERR: " . $conn->error;
}

echo $_POST['reg_type'];
$enabled        = $conn->real_escape_string($_POST['enabled']);
$srv_addr       = $conn->real_escape_string($_POST['srv_addr']);
$srv_port       = $conn->real_escape_string($_POST['srv_port']);
$base_topic     = $conn->real_escape_string($_POST['base_topic']);
$crt_enabled    = $conn->real_escape_string($_POST['crt_enabled']);
$username       = $conn->real_escape_string($_POST['username']);
$password       = $conn->real_escape_string($_POST['password']);
$read_interval  = $conn->real_escape_string($_POST['read_interval']);
$crt_name       = $conn->real_escape_string($_POST['crt_name']);
$key_name       = $conn->real_escape_string($_POST['key_name']);
$ca_name        = $conn->real_escape_string($_POST['ca_name']);


$sql = "INSERT INTO mqtt_configs (enabled,srv_addr, srv_port, base_topic, crt_enabled,username,password,read_interval,crt_name,key_name,ca_name)
VALUES ('".$enabled."','".$srv_addr."','".$srv_port."','".$base_topic."','".$crt_enabled."','".$username."','".$password."','".$read_interval."','".$crt_name."','".$key_name."','".$ca_name."')";
if ($conn->query($sql) != TRUE) {
    echo "ERR: " . $sql . "<br>" . $conn->error;
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

$conn->close();
?>
