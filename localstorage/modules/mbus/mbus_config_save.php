<?php
require_once '../connection.php';
$conn    = Connect();
if (isset($_POST['enabled'])) {
    $enabled        = 1;
} else {
    $enabled        = 0;
}
    $baud_rate      = $conn->real_escape_string($_POST['baud_rate']);
    $parity         = $conn->real_escape_string($_POST['parity']);
    $stop_bits      = $conn->real_escape_string($_POST['stop_bits']);
    $data_bits      = $conn->real_escape_string($_POST['data_bits']);
    $read_interval  = $conn->real_escape_string($_POST['read_interval']);
    $read_timeout   = $conn->real_escape_string($_POST['read_timeout']);
    $sql = "UPDATE mbus_configs SET
    enabled = ".$enabled.",
    baud_rate=".$baud_rate.",
    parity='".$parity."',
    stop_bits=".$stop_bits.",
    data_bits=".$data_bits.",
    read_interval=".$read_interval.",
    read_timeout=".$read_timeout."
    WHERE id = 1";
if ($conn->query($sql) != true) {
    alert("ERR: " . $sql . "<br/>" . $conn->error);
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$conn->close();
?>
