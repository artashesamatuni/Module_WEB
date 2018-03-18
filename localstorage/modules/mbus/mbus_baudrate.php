<?php
require_once '../connection.php';
echo "<label>Baudrate</label>
    <select name=\"baud_rate\" class=\"w3-select\" value=\"".$mbus_row["baud_rate"]."\">\n";
$conn    = Connect();
$sql = "SELECT id,baud_rates FROM mbus_baud_rates";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
if ($mbus_row["baud_rate"]==$row["baud_rates"]) {
echo "<option value=\"".$row["baud_rates"]."\" selected>".$row["baud_rates"]."</option>\n";
} else {
echo "<option value=\"".$row["baud_rates"]."\">".$row["baud_rates"]."</option>\n";
}
}
$conn->close();
} else {
#
}
echo "</select>\n";
 ?>
