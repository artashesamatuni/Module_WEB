<?php
require_once '../connection.php';
if (isset($_POST['enabled'])) {
    $enabled=1;
} else {
    $enabled=0;
}
if (isset($_POST['polarity'])) {
    $polarity=1;
} else {
    $polarity=0;
}
$conn    = Connect();
$id         = $conn->real_escape_string($_POST['id']);
$name       = $conn->real_escape_string($_POST['name']);

$sql = "UPDATE di_configs SET name = '".$name."', polarity=".$polarity.", enabled=".$enabled." WHERE id = ".$id."";
if ($conn->query($sql)!=true) {
    echo "ERR: " . $sql . "<br>" . $conn->error;
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$conn->close();
?>
