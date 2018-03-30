<?php
require_once '../connection.php';
require_once '../soc.php';
if (isset($_POST['enabled'])) {
    $enabled=1;
} else {
    $enabled=0;
}
$conn    = Connect();
$id         = $conn->real_escape_string($_POST['id']);
$name       = $conn->real_escape_string($_POST['name']);
$unit       = $conn->real_escape_string($_POST['unit']);
$min        = $conn->real_escape_string($_POST['min']);
$max        = $conn->real_escape_string($_POST['max']);

$sql = "UPDATE ai_configs SET name = '".$name."', unit='".$unit."', min=".$min.",max=".$max.",enabled=".$enabled." WHERE id = ".$id."";
if ($conn->query($sql)!=true) {
    echo "ERR: " . $sql . "<br>" . $conn->error;
} else {
    $msg = "ai_update";
    send($msg);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$conn->close();
?>
