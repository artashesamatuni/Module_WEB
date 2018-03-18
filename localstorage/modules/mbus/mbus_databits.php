<?php
require_once '../connection.php';
echo "<label>DataBits</label>
      <select name=\"data_bits\" class=\"w3-select\" value=\"".$mbus_row["data_bits"]."\">";
$conn    = Connect();
$sql = "SELECT id, data_bits FROM mbus_data_bits";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($mbus_row["data_bits"]==$row["data_bits"]) {
            echo "<option value=\"".$row["data_bits"]."\" selected>".$row["data_bits"]."</option>\n";
        } else {
            echo "<option value=\"".$row["data_bits"]."\">".$row["data_bits"]."</option>\n";
        }
    }
} else {
#
}
echo "</select>\n";
 ?>
