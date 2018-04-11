<?php
require_once '../connection.php';
require_once '../soc.php';
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
$mode       = $conn->real_escape_string($_POST['mode']);

$sql = "UPDATE rl_configs SET name = '".$name."', polarity=".$polarity.", enabled=".$enabled.", mode=".$mode." WHERE id = ".$id."";

if ($conn->query($sql)!=true) {
    echo "ERR: " . $sql . "<br>" . $conn->error;
}

switch ($mode)
{
    case 1:
    break;
    case 2:
        if (isset($_POST['source'])) {
            $source = $conn->real_escape_string($_POST['source']);
        }
        else {
            $source = 1;
        }


        if (isset($_POST['channel'])) {
            $channel = $conn->real_escape_string($_POST['channel']);
        }
        else {
            $channel = 1;
        }
        if (isset($_POST['operator'])) {
            $operator = $conn->real_escape_string($_POST['operator']);
        }
        else {
            $operator = 1;
        }
        if (isset($_POST['value'])) {
            $value = $conn->real_escape_string($_POST['value']);
        }
        else {
            $value = 0;
        }
        if (isset($_POST['on_delay'])) {
            $on_delay = $conn->real_escape_string($_POST['on_delay']);
        }
        else {
            $on_delay =0;
        }
        if (isset($_POST['off_delay'])) {
            $off_delay = $conn->real_escape_string($_POST['off_delay']);
        }
        else {
            $off_delay=0;
        }

        $sql = "UPDATE rl_input_settings SET source='".$source."', channel='".$channel."', operator='".$operator."', value=".$value.", on_delay=".$on_delay.", off_delay=".$off_delay." WHERE id = ".$id."";
        if ($conn->query($sql)!=true) {
            echo "ERR: " . $sql . "<br>" . $conn->error;
        }
    break;
    case 3:
        if (isset($_POST['on'])) {
            $on_duration = $conn->real_escape_string($_POST['on']);
        }
        else {
            $on_duration = 0;
        }
        if (isset($_POST['off'])) {
            $off_duration = $conn->real_escape_string($_POST['off']);
        }
        else {
            $off_duration = 0;
        }
        $sql = "UPDATE rl_time_settings SET on_duration = ".$on_duration.", off_duration =".$off_duration." WHERE id = ".$id."";
        if ($conn->query($sql)!=true) {
            echo "ERR: " . $sql . "<br>" . $conn->error;
        }
    break;
    case 4:
    break;
}

$msg = "do_update";
send($msg);
header('Location: ' . $_SERVER['HTTP_REFERER']);

$conn->close();




 ?>
