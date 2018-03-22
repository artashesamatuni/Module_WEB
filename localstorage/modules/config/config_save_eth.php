<?php
require '../connection.php';
require '../basic.php';

    $conn= Connect();
    if (isset($_POST['dhcp'])) {
        $dhcp=1;
    } else {
        $dhcp=0;
    }

    $ip             = $conn->real_escape_string($_POST['ip']);
    $mask           = $conn->real_escape_string($_POST['mask']);
    $gateway        = $conn->real_escape_string($_POST['gateway']);
    $broadcast      = $conn->real_escape_string($_POST['broadcast']);
    $nameserver     = $conn->real_escape_string($_POST['nameserver']);
    $domain         = $conn->real_escape_string($_POST['domain']);
    $search         = $conn->real_escape_string($_POST['search']);

    $sql = "UPDATE eth_configs SET
    dhcp = ".$dhcp.",
    ip='".$ip."',
    mask='".$mask."',
    gateway='".$gateway."',
    broadcast='".$broadcast."',
    nameserver='".$nameserver."',
    domain='".$domain."',
    search='".$search."' WHERE id = 1";
    if ($conn->query($sql)!=true) {
        alert("ERR: " . $sql . "<br/>" . $conn->error);
    } else {
        snackbar("Done");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    $conn->close();
?>
