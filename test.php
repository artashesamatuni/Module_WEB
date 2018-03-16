<?php
require 'basic.php';
require 'menu.php';
require 'connection.php';


head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>";
echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";
$cur = 'Digital Outputs';
show_menu($cur);


$conn    = Connect();

$sql = "DROP TABLE mbus_configs";

if ($conn->query($sql) != true) {
    echo "ERR: " . $conn->error;
}

$sql = "CREATE TABLE mbus_configs (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
enabled         TINYINT,
baud_rate       INT NOT NULL,
parity          TEXT NOT NULL,
stop_bits       TINYINT NOT NULL,
data_bits       TINYINT NOT NULL,
read_interval   INT NOT NULL,
read_timeout    INT NOT NULL
)";

if ($conn->query($sql) != true) {
    echo "ERR: " . $conn->error;
}

echo $_POST['reg_type'];
$enabled        = 1;
$baud_rate      = 1;//$conn->real_escape_string($_POST['baud_rate']);
$parity         = 2;//$conn->real_escape_string($_POST['parity']);
$stop_bits      = 1;//$conn->real_escape_string($_POST['stop_bits']);
$data_bits      = 1;//$conn->real_escape_string($_POST['data_bits']);
$read_interval  = 5;//$conn->real_escape_string($_POST['read_interval']);
$read_timeout   = 50;//$conn->real_escape_string($_POST['read_timeout']);



$sql = "INSERT INTO mbus_configs (enabled,baud_rate, parity, stop_bits,data_bits,read_interval,read_timeout)
VALUES ('".$enabled."','".$baud_rate."','".$parity."','".$stop_bits."','".$data_bits."','".$read_interval."','".$read_timeout."')";
if ($conn->query($sql) != true) {
    echo "ERR: " . $sql . "<br>" . $conn->error;
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


$conn->close();


footer();
echo "</div>
</body>
</html>";
