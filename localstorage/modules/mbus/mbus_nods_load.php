<?php
require_once '../connection.php';
$conn = Connect();
echo "<br/>\n";
echo "<form method=\"post\">\n";
echo "<table class=\"w3-table w3-border\">
    <tr class=\"w3-blue\">
      <th>#</th>
      <th>Name</th>
      <th>Dev. addr.</th>
      <th>Reg. addr.</th>
      <th>Reg. type</th>
      <th>Unit</th>
      <th>Slope</th>
      <th>Offset</th>
      <th>32 bit</th>
      <th>IEEE754</th>
      <th>Low First</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>\n";

$sql = "SELECT id, name, dev_addr, reg_addr,reg_type,unit,slope,offset,bit32,ieee754,low_first FROM mbus_nods";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<tbody>\n";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>\n";
        echo "<td>".$row["id"]."</td>\n";
        echo "<td>".$row["name"]."</td>\n";
        echo "<td>".$row["dev_addr"]."</td>\n";
        echo "<td>".$row["reg_addr"]."</td>\n";
        $sql = "SELECT reg_types FROM mbus_reg_types WHERE id=2";//".$row["reg_type"]."\"";
        $reg_types_result = $conn->query($sql);
        $row1 = $reg_types_result->fetch_assoc();

        echo "<td>".$row1["reg_types"]."</td>\n";
        echo "<td>".$row["unit"]."</td>\n";
        echo "<td>".$row["slope"]."</td>\n";
        echo "<td>".$row["offset"]."</td>\n";
        if ($row["bit32"]) {
            echo "<td><input type=\"checkbox\" class=\"w3-check\" checked=\"checked\" disabled/></td>\n";
        } else {
            echo "<td><input type=\"checkbox\" class=\"w3-check\" disabled/></td>\n";
        }
        if ($row["ieee754"]) {
            echo "<td><input type=\"checkbox\" class=\"w3-check\" checked=\"checked\" disabled/></td>\n";
        } else {
            echo "<td><input type=\"checkbox\" class=\"w3-check\" disabled/></td>\n";
        }
        if ($row["low_first"]) {
            echo "<td><input type=\"checkbox\" class=\"w3-check\" checked=\"checked\" disabled/></td>\n";
        } else {
            echo "<td><input type=\"checkbox\" class=\"w3-check\" disabled/></td>\n";
        }
        echo "<td><input type=\"submit\" name=\"edit".$row["id"]."\" class=\"w3-button w3-right w3-gray w3-text-white w3-card-4\" value=\"Edit\"/></td>\n";
        echo "<td><input type=\"submit\" name=\"delete".$row["id"]."\" class=\"w3-button w3-right w3-red w3-card-4\" value=\"&times;\"/></td>\n";
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
