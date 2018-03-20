<?php
require_once '../connection.php';
require_once '../basic.php';

$target_dir = "/root/cert/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


if (!file_exists($target_dir)) {
    if (!mkdir($target_dir, 0777, true)) {
        die('Failed to create folders...');
    }
}

if (file_exists($target_file)) {
    unlink($target_file);
}

if ($_FILES["fileToUpload"]["size"] > 5000) {
    $uploadOk = 0;
}

if ($FileType != "crt" && $FileType != "pem" && $FileType != "key") {
    $uploadOk = 0;
}

if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $conn    = Connect();
        if ($FileType == "pem")
        {
            $name       =$target_file;
            $sql            = "UPDATE mqtt_configs SET
            crt_name        ='".$name."'
            WHERE id        = 1";
        }
        if ($FileType == "key")
        {
            $name       =$target_file;
            $sql            = "UPDATE mqtt_configs SET
            key_name        ='".$name."'
            WHERE id        = 1";
        }
        if ($FileType == "crt")
        {
            $name       =$target_file;
            $sql            = "UPDATE mqtt_configs SET
            ca_name        ='".$name."'
            WHERE id        = 1";
        }
        if ($conn->query($sql) != true) {
            alert("ERR: " . $sql . "<br/>" . $conn->error);
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        $conn->close();
    }
    else {
        alert("ERROR");
    }
} else {
    alert("ERROR");
}
?>
