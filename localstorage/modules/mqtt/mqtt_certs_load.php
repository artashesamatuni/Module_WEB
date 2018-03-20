<?php
require_once '../connection.php';
$conn    = Connect();

$sql = "SELECT id,  crt_name, key_name, ca_name FROM mqtt_configs";
$result = $conn->query($sql);
echo "<br/>
      <div class=\"w3-row-padding w3-container\">
      <table class=\"w3-table w3-border\">
        <tr>
            <th>Type</th>
            <th>File</th>
        </tr>
        <tbody>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>PEM</td>
                <td>".$row["crt_name"]."</td>
            </tr>
            <tr>
                <td>KEY</td>
                <td>".$row["key_name"]."</td>
            </tr>
            <tr>
                <td>CRT</td>
                <td>".$row["ca_name"]."</td>
            </tr>";
    }
echo "</tbody>";
} else {

}
echo "</table>
      </div>
      <br/>\n";
      echo "<div class=\"w3-row-padding\">
                <div class=\"w3-col m12 s12\">
                  <button onclick=\"document.getElementById('upload').style.display='block'\" class=\"w3-button w3-block w3-green\">Upload Certificates</button>
                </div>
           </div>\n";
echo "<br/>\n";
$conn->close();






 ?>
