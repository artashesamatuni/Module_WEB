<?php
require 'basic.php';
require 'menu.php';
require 'connection.php';


head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>";
echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";
$cur = 'Digital Outputs';
show_menu($cur);


echo "<table>";
$conn    = Connect();

$rl_status_sql = "SELECT rl_status.id, rl_status.state, rl_configs.name
FROM rl_status
INNER JOIN rl_configs
ON rl_status.id=rl_configs.id";
$rl_status_result = $conn->query($rl_status_sql);
echo $rl_status_result->num_rows;
if ($rl_status_result->num_rows > 0) {
    while ($rl_status_row = $rl_status_result->fetch_assoc()) {
        echo "<tr>
                      <td style='width: 10%'>".$rl_status_row['id']."</td>
                      <td style='width: 10%'>".$rl_status_row['state']."</td>
                      <td style='width: 20%'>".$rl_status_row['name']."</td>
              </tr>";
    }
} else {
    echo "No results";
}
echo "</table>";

$conn->close();


footer();
echo "</div>
</body>
</html>";
