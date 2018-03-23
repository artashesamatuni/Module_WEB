<?php
echo "<label>Parity</label>
      <select name=\"parity\" class=\"w3-select\" value=\"".$mbus_row["parity"]."\">";
$conn    = Connect();
$sql = "SELECT id,parity FROM mbus_parity";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($mbus_row["parity"]==$row["parity"]) {
            echo "<option value=\"".$row["parity"]."\" selected>".$row["parity"]."</option>\n";
        } else {
            echo "<option value=\"".$row["parity"]."\">".$row["parity"]."</option>\n";
        }
    }
} else {
#
}
echo "</select>\n";
 ?>
