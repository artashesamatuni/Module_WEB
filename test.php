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

$sql = "SELECT cpu_temp,  mqtt_conn, local_ip
FROM dev_status";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<br/>Temperature: ".$row[cpu_temp]." C";
        echo "<br/>MQTT status: ".$row[mqtt_conn];
        echo "<br/>Local IP: ".$row[local_ip];
    }
} else {
    echo "No results";
}


$conn->close();


footer();
echo "</div>
</body>
</html>";
