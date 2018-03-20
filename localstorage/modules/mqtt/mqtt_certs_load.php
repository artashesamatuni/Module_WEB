<?php
require_once '../connection.php';
$conn    = Connect();
echo "<br/>";
$sql = "SELECT id,  crt_name, key_name, ca_name FROM mqtt_configs";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>".$row["crt_name"]."</p>\n";
        echo "<p>".$row["key_name"]."</p>\n";
        echo "<p>".$row["ca_name"]."</p>\n";
            echo "<br/>";
            echo "<div class=\"w3-row-padding\">
                    <div class=\"w3-col m12 s12\">
                        <div class=\"w3-right\">
                            <button onclick=\"document.getElementById('upload').style.display='block'\" class=\"w3-button w3-green\">Upload Certificates</button>
                        </div>
                    </div>
                </div>\n";
            echo "<br/>";
        echo "<br/>\n";
    }
} else {
    echo "0 results";
}
$conn->close();






 ?>
