<?php
require_once "localstorage/modules/connection.php";
echo "<form method=\"post\" action=\"localstorage/modules/dashboard/button.php\">
<div class='w3-panel w3-border'>
<h4>Relay Outputs</h4>\n";
$conn    = Connect();
$sql = "SELECT rl_status.id, rl_status.state, rl_configs.name
FROM rl_status
INNER JOIN rl_configs
ON rl_status.id=rl_configs.id";
$result = $conn->query($sql);
echo "<form>\n";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<button type=\"submit\" name=\"do".$row["id"]."\" class=\"w3-button w3-block ";
        if ($row['state']) {
            echo "w3-green";
        } else {
            echo "w3-red";
        }
        echo "\">".$row["name"];
        if ($row['state']) {
            echo "ON";
        } else {
            echo "OFF";
        }
        echo "</button>\n";
        echo "<br/>";
    }
} else {
    echo "No results";
}
echo "</form>";
$conn->close();
echo "</div>
</form>\n";





 ?>
