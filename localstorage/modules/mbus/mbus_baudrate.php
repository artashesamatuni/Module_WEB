<?php
require_once '../connection.php';
echo "<label>Baudrate</label>
    <select name=\"baud_rate\" class=\"w3-select\" value=\"".$mbus_row["baud_rate"]."\">\n";
$conn    = Connect();
$baud_rates_sql = "SELECT id,baud_rates FROM mbus_baud_rates";
$baud_rates_result = $conn->query($baud_rates_sql);
if ($baud_rates_result->num_rows > 0) {
while ($baud_rates_row = $baud_rates_result->fetch_assoc()) {
if ($mbus_row["baud_rate"]==$baud_rates_row["baud_rates"]) {
echo "<option value=\"".$baud_rates_row["baud_rates"]."\" selected>".$baud_rates_row["baud_rates"]."</option>\n";
} else {
echo "<option value=\"".$baud_rates_row["baud_rates"]."\">".$baud_rates_row["baud_rates"]."</option>\n";
}
}
$conn->close();
} else {
#
}
echo "</select>\n";
 ?>
