<?php
require_once '../connection.php';
$conn = Connect();
echo "<br/>\n";
echo "<form method=\"post\" action=\"mbus_nods_delete.php\">\n";
echo "<table class=\"w3-table w3-border\">
    <tr class=\"w3-blue\">
      <th>Node</th>
      <th>Dev. addr.</th>
      <th>Reg. addr.</th>
      <th>Unit</th>
      <th></th>
    </tr>\n";

$sql = "SELECT id, name, dev_addr, reg_addr,unit FROM mbus_nods";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<tbody>\n";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>\n";
        echo "<td>".$row["name"]."</td>\n";
        echo "<td>".$row["dev_addr"]."</td>\n";
        echo "<td>".$row["reg_addr"]."</td>\n";
        echo "<td>".$row["unit"]."</td>\n";
        echo "<td><button type=\"submit\" name=\"edit\" value=\"".$row["id"]."\" class=\"w3-button w3-blue\"><i class=\"fa fa-edit\"></i></button>
                  <button type=\"submit\" name=\"remove\" value=\"".$row["id"]."\" class=\"w3-button w3-red\"><i class=\"fa fa-remove\"></i></button>
              </td>\n";
        echo "</tr>\n";
    }
    echo "</tbody>\n";
} else {
    echo "No data";
}
echo "</table>\n";
echo "</form>
  <br/>\n";



$conn->close();
?>
