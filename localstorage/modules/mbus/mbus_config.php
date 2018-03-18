<?php
require_once '../connection.php';
$conn    = Connect();
echo "<br/>
      <form method=\"post\" action=\"mbus_config_save.php\">";
$mbus_sql = "SELECT enabled, baud_rate, parity, stop_bits,data_bits,read_interval,read_timeout FROM mbus_configs";
$mbus_result = $conn->query($mbus_sql);
if ($mbus_result->num_rows > 0) {
    while ($mbus_row = $mbus_result->fetch_assoc()) {
        echo "<hr/>";
        echo $mbus_row["enabled"];
        echo $mbus_row["baud_rate"];
        echo "<hr/>";
        echo "<div class=\"w3-row-padding\">
                <div class=\"w3-col m1 s4\">
                    <label>Enable</label>
                    <br/>";
        if ($mbus_row["enabled"]==1) {
            echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"1\" checked=\"checked\"/>\n";
        } else {
            echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"0\" />\n";
        }
        echo "</div>
                <div class=\"w3-col m2 s4\">";
                require_once 'mbus_baudrate.php';
        echo "</div>\n";
        echo "<div class=\"w3-col m2 s4\">";
                require_once 'mbus_parity.php';
        echo "</div>\n";
        echo "<div class=\"w3-col m1 s3\">
                <label>StopBits</label>
                <select name=\"stop_bits\" class=\"w3-select\" value=\"".$mbus_row["stop_bits"]."\">";
        $stop_bits_sql = "SELECT id, stop_bits FROM mbus_stop_bits";
        $stop_bits_result = $conn->query($stop_bits_sql);

        if ($stop_bits_result->num_rows > 0) {
            while ($stop_bits_row = $stop_bits_result->fetch_assoc()) {
                if ($mbus_row["stop_bits"]==$stop_bits_row["stop_bits"]) {
                    echo "<option value=\"".$stop_bits_row["stop_bits"]."\" selected>".$stop_bits_row["stop_bits"]."</option>\n";
                } else {
                    echo "<option value=\"".$stop_bits_row["stop_bits"]."\">".$stop_bits_row["stop_bits"]."</option>\n";
                }
            }
        } else {
            echo "0 results";
        }
        echo "</select>
            </div>\n";
        echo "<div class=\"w3-col m1 s3\">
                <label>DataBits</label>
                <select name=\"data_bits\" class=\"w3-select\" value=\"".$mbus_row["data_bits"]."\">";
        $data_bits_sql = "SELECT id, data_bits FROM mbus_data_bits";
        $data_bits_result = $conn->query($data_bits_sql);

        if ($data_bits_result->num_rows > 0) {
            while ($data_bits_row = $data_bits_result->fetch_assoc()) {
                if ($mbus_row["data_bits"]==$data_bits_row["data_bits"]) {
                    echo "<option value=\"".$data_bits_row["data_bits"]."\" selected>".$data_bits_row["data_bits"]."</option>\n";
                } else {
                    echo "<option value=\"".$data_bits_row["data_bits"]."\">".$data_bits_row["data_bits"]."</option>\n";
                }
            }
        } else {
            echo "0 results";
        }
        echo "</select>
            </div>\n";
        echo "<div class=\"w3-col m2 s3\">
                <label>Timeout[sec.]</label>
                <input name=\"read_timeout\" class=\"w3-input w3-border\" type=\"number\" min=\"1\" max=\"5\" value=\"".$mbus_row["read_timeout"]."\" />
              </div>";
        echo "<div class=\"w3-col m2 s3\">
                <label>Interval[sec.]</label>
                <input name=\"read_interval\" class=\"w3-input w3-border\" type=\"number\" min=\"1\" max=\"300\" value=\"".$mbus_row["read_interval"]."\" />
            </div>\n";
        echo "</div>";
        echo "<div class=\"w3-row-padding\">
        <div class=\"w3-right\">
                <input type=\"submit\" class=\"w3-button w3-gray w3-text-white w3-card-4\" value=\"Save\" />
            </div>
        </div>";
        echo "</form>
          <br/>\n";
    }
} else {
    echo "0 results";
}

$conn->close();
 ?>
