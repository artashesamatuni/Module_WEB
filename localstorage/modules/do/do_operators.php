<?php
echo "<label>Function</label>
      <select name=\"operator\" class=\"w3-select\" value=\"".$row["id"]."\">\n";
$conn    = Connect();
$sql = "SELECT id,name FROM rl_operators";
$result = $conn->query($sql);
$conn->close();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value=\"".$row["id"]."\">".$row["name"]."</option>\n";
    }
}
echo "</select>\n";
?>
