<?php
require_once "localstorage/modules/connection.php";
echo "<div class='w3-panel w3-border'>
        <h4>Digital Input</h4>";
$conn = Connect();
$sql = "SELECT di_status.state, di_configs.name
FROM di_status
INNER JOIN di_configs
ON di_status.id=di_configs.id";
$result = $conn->query($sql);
$conn->close();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class=\"w3-card-4 w3-center w3-padding";
        if ($row['state']) {
            echo " w3-light-gray\">";
        } else {
            echo " w3-gray\">";
        }
        echo $row['name']." ";
        if ($row['state']) {
            echo "ON";
        } else {
            echo "OFF";
        }
        echo "</div>\n<br/>\n";
    }
} else {
    echo "No results";
}

echo "</div>\n";
 ?>
