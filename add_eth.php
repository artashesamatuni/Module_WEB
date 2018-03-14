<?php
require 'connection.php';
$conn    = Connect();

drop_table();
add_table();
add_data();
$conn->close();



function drop_table() {
    $sql = "DROP TABLE network";

    if ($conn->query($sql) === TRUE) {
        echo "Table nods deleted successfully";
    } else {
        echo "Error deleting table: " . $conn->error;
    }
}

function add_table() {
    $sql = "CREATE TABLE network (
    dhcp INT(1) NOT NULL,
    ip VARCHAR(16) NOT NULL,
    mask VARCHAR(16) NOT NULL,
    gateway VARCHAR(16) NOT NULL,
    broadcast VARCHAR(16),
    nameserver VARCHAR(120),
    domain VARCHAR(120),
    search VARCHAR(120)
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table nods created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

function add_data() {
    $dhcp       = $conn->real_escape_string($_POST['dhcp']);
    $ip         = $conn->real_escape_string($_POST['ip']);
    $mask       = $conn->real_escape_string($_POST['mask']);
    $gateway    = $conn->real_escape_string($_POST['gateway']);
    $broadcast  = $conn->real_escape_string($_POST['broadcast']);
    $nameserver = $conn->real_escape_string($_POST['nameserver']);
    $domain     = $conn->real_escape_string($_POST['domain']);
    $search     = $conn->real_escape_string($_POST['search']);



    $sql = "INSERT INTO network (dhcp, ip, mask,gateway,broadcast,nameserver,domain,search)
    VALUES ('".$dhcp."','".$ip."','".$mask."','".$gateway."','".$broadcast."','".$nameserver."','".$domain."','".$search."')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
