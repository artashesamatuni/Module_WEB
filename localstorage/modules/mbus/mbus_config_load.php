<?php
require_once '../connection.php';
$conn    = Connect();
echo "<br/>
      <form method=\"post\" action=\"mbus_config_save.php\">\n";
$mbus_sql = "SELECT id, enabled, baud_rate, parity, stop_bits, data_bits, read_interval, read_timeout FROM mbus_configs";
$mbus_result = $conn->query($mbus_sql);
if ($mbus_result->num_rows > 0) {
    while ($mbus_row = $mbus_result->fetch_assoc()) {
        echo "<input type=\"hidden\" name=\"id\" value=\"".$mbus_row["id"]."\" />\n";
        echo "<div class=\"w3-row-padding\">
                <div class=\"w3-col m2 s2\">
                    <label>Enable</label>
                    <br/>\n";
        if ($mbus_row["enabled"]==1) {
            echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"1\" checked=\"checked\"/>\n";
        } else {
            echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"0\" />\n";
        }
        echo "</div>
                <div class=\"w3-col m3 s3\">";
                require_once 'mbus_baudrate.php';
        echo "</div>\n";
        echo "<div class=\"w3-col m3 s3\">";
                require_once 'mbus_parity.php';
        echo "</div>\n";
        echo "<div class=\"w3-col m2 s2\">";
                require_once 'mbus_stopbits.php';
        echo "</div>\n";
        echo "<div class=\"w3-col m2 s2\">";
                require_once 'mbus_databits.php';
        echo "</div>
            </div>
            <br/>\n";
        echo "<div class=\"w3-row-padding\">
                <div class=\"w3-col m2 s2\">&nbsp;</div>
                <div class=\"w3-col m3 s3\">
                <label>Timeout[sec.]</label>
                <input name=\"read_timeout\" class=\"w3-input w3-border\" type=\"number\" min=\"1\" max=\"5\" value=\"".$mbus_row["read_timeout"]."\" />
              </div>\n";
        echo "<div class=\"w3-col m3 s3\">
                <label>Interval[sec.]</label>
                <input name=\"read_interval\" class=\"w3-input w3-border\" type=\"number\" min=\"1\" max=\"300\" value=\"".$mbus_row["read_interval"]."\" />
            </div>
            <div class=\"w3-col m4 s4\">&nbsp;</div>\n";
        echo "</div>
        <br/>\n";
        echo "<div class=\"w3-row-padding\">
                <div class=\"w3-col m12 s12\">
                        <input type=\"submit\" name=\"insert".$row["id"]."\" class=\"w3-button w3-block w3-green\" value=\"Save\" />
                </div>
            </div>\n";
        echo "</form>
          <br/>\n";
    }
} else {
    echo "0 results";
}

$conn->close();
 ?>
