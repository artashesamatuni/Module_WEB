<?php
echo "<label>StopBits</label>
      <select name=\"stop_bits\" class=\"w3-select\" value=\"".$mbus_row["stop_bits"]."\">";
      $conn    = Connect();
      $sql = "SELECT id, stop_bits FROM mbus_stop_bits";
      $result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($mbus_row["stop_bits"]==$row["stop_bits"]) {
            echo "<option value=\"".$row["stop_bits"]."\" selected>".$row["stop_bits"]."</option>\n";
        } else {
            echo "<option value=\"".$row["stop_bits"]."\">".$row["stop_bits"]."</option>\n";
        }
    }
}
echo "</select>\n";
?>
