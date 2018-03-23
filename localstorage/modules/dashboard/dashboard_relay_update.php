<?php
require_once "../connection.php";
$conn    = Connect();
$sql = "SELECT rl_status.id, rl_status.state, rl_configs.name
FROM rl_status
INNER JOIN rl_configs
ON rl_status.id=rl_configs.id";
$result = $conn->query($sql);
$conn->close();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<button type=\"submit\" name=\"do".$row["id"]."\" class=\"w3-button w3-block w3-card-4 ";
        if ($row['state']) {
            echo "w3-green";
        } else {
            echo "w3-red";
        }
        echo "\">".$row["name"];
        if ($row['state']) {
            echo " ON";
        } else {
            echo " OFF";
        }
        echo "</button>\n";
        echo "<br/>";
    }
}





 ?>
