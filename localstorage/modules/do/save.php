<?php
require_once '../connection.php';
require_once '../basic.php';
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

$sql = "UPDATE rl_configs SET name = '".$name."', polarity=".$polarity.", enabled=".$enabled." WHERE id = ".$id."";
echo $sql;
if ($conn->query($sql)!=true) {
    echo "ERR: " . $sql . "<br>" . $conn->error;
} else {
    snackbar("Done");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$conn->close();




 ?>
