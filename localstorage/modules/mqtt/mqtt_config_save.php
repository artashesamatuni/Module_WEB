<?php
require_once '../connection.php';
require_once '../basic.php';

$conn    = Connect();
if (isset($_POST['enabled'])) {
    $enabled        = 1;
} else {
    $enabled        = 0;
}
if (isset($_POST['crt_enabled'])) {
    $crt_enabled        = 1;
} else {
    $crt_enabled        = 0;
}

    $srv_addr       = $conn->real_escape_string($_POST['addr']);
    $srv_port       = $conn->real_escape_string($_POST['port']);
    $base_topic     = $conn->real_escape_string($_POST['topic']);
    $prefix         = $conn->real_escape_string($_POST['prefix']);
    $username       = $conn->real_escape_string($_POST['username']);
    $password       = $conn->real_escape_string($_POST['mqtt_password']);
    $read_interval  = $conn->real_escape_string($_POST['mqtt_interval']);
    $crt_name       ="a.crt";
    $key_name       ="a.key";
    $ca_name        ="a.ca";
    $sql            = "UPDATE mqtt_configs SET
    enabled         = ".$enabled.",
    srv_addr        ='".$srv_addr."',
    srv_port        =".$srv_port.",
    base_topic      ='".$base_topic."',
    prefix          ='".$prefix."',
    crt_enabled     =".$crt_enabled.",
    username        ='".$username."',
    password        ='".$password."',
    crt_name        ='".$crt_name."',
    key_name        ='".$key_name."',
    ca_name         ='".$ca_name."'
    WHERE id        = 1";
if ($conn->query($sql) != true) {
    alert("ERR: " . $sql . "<br/>" . $conn->error);
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$conn->close();
?>
