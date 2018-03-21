<?php
require_once "connection.php";
$conn    = Connect();
echo "<div class='w3-panel w3-border'>
        <h4>Modbus Nods</h4>
        <table class=\"w3-table w3-border 3w-card-4\">
    <tr class=\"w3-light-gray\">
      <th>Name</th>
      <th>Value</th>
    </tr>\n";
$sql = "SELECT mbus_nods.name, mbus_nods.unit, mbus_nods_values.value
FROM mbus_nods
INNER JOIN mbus_nods_values
ON mbus_nods.id=mbus_nods_values.id";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<tbody>\n";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["name"]."</td>
                <td>".$row["value"]." ".$row["unit"]."</td>
             </tr>\n";
    }
    echo "</tbody>\n";
} else {
    echo "No data";
}
echo "</table>
  <br/>
</div>\n";
$conn->close();
 ?>
