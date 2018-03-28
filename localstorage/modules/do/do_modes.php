<?php
echo "<label>Modes</label>
      <select name=\"mode\" class=\"w3-select\" value=\"".$row["mode"]."\">\n";
$conn    = Connect();
$sql = "SELECT id,name FROM rl_modes";
$result = $conn->query($sql);
$conn->close();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value=\"".$row["id"]."\">".$row["name"]."</option>\n";
    }
}
echo "</select>\n";
?>
