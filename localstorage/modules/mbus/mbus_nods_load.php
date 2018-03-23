<?php
$conn = Connect();
echo "<br/>\n";
echo "<form method=\"post\" action=\"modules/mbus/mbus_nods_delete.php\">\n";
    echo "<div class=\"w3-row-padding\">\n";
    echo "<div class=\"w3-col m3 s3\">Name</div>\n";
    echo "<div class=\"w3-col m2 s2\">Dev.</div>\n";
    echo "<div class=\"w3-col m2 s2\">Reg.</div>\n";
    echo "<div class=\"w3-col m3 s3\">Unit</div>\n";
    echo "<div class=\"w3-col m1 s1\">&nbsp;</div>\n";
    echo "<div class=\"w3-col m1 s1\">&nbsp;</div>\n";
    echo "</div>\n";
$sql = "SELECT id, name, dev_addr, reg_addr,unit FROM mbus_nods";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class=\"w3-row\">\n";
        echo "<div class=\"w3-col m3 s3\"><input class=\"w3-input\" type=\"text\"value=\"".$row["name"]."\"/></div>\n";
        echo "<div class=\"w3-col m2 s2\"><input class=\"w3-input\" type=\"number\"value=\"".$row["dev_addr"]."\"/></div>\n";
        echo "<div class=\"w3-col m2 s2\"><input class=\"w3-input\" type=\"number\"value=\"".$row["reg_addr"]."\"/></div>\n";
        echo "<div class=\"w3-col m3 s3\"><input class=\"w3-input\" type=\"text\"value=\"".$row["unit"]."\"/></div>\n";
        echo "<div class=\"w3-col m1 s1\"><button type=\"submit\" name=\"edit\" onclick=\"document.getElementById('edit').style.display='block'\" value=\"".$row["id"]."\" class=\"w3-button w3-green\"><i class=\"fa fa-edit\"></i></button></div>\n";
        echo "<div class=\"w3-col m1 s1\"><button type=\"submit\" name=\"remove\" value=\"".$row["id"]."\" class=\"w3-button w3-red\"><i class=\"fa fa-remove\"></i></button></div>\n";
        echo "</div>\n";
    }
} else {
    echo "No data";
}
echo "</form>
      <br/>\n";
echo "<div class=\"w3-row\">
        <div class=\"w3-col m12 s12\">
                <button onclick=\"document.getElementById('add').style.display='block'\" class=\"w3-button w3-block w3-green\">Add new</button>
        </div>
    </div>\n";
  echo "<br/>\n";
$conn->close();
?>
