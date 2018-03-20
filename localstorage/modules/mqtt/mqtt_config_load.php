<?php
require_once '../connection.php';
$conn = Connect();
echo "<br/>
      <form method=\"post\" action=\"mqtt_config_save.php\">";
$sql = "SELECT id, enabled, srv_addr, srv_port, base_topic, prefix, crt_enabled, username, password, read_interval, crt_name, key_name, ca_name FROM mqtt_configs";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<input type=\"hidden\" name=\"id\" value=\"".$row["id"]."\" />\n";
        echo "<div class=\"w3-row-padding\">\n";
        echo "<div class=\"w3-col m2 s2\">
                    <label>Enable</label>
                    <br/>\n";
        if ($row["enabled"] == 1) {
            echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"1\" checked=\"checked\"/>\n";
            $disabled = " ";
        } else {
            echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"0\" />\n";
            $disabled = "disabled";
        }
        echo "</div>\n";
        echo "<div class=\"w3-col m10 s10\">
                    <label>Server*</label>
                    <input name=\"addr\" class=\"w3-input w3-border\" type=\"text\" size=\"36\" placeholder=\"e.g. test.mosquitto.org\" value=\"".$row["srv_addr"]."\"/>
                </div>\n";
        echo "<div class=\"w3-col m6 s6\">
                    <label>Base-topic*</label>
                    <input name=\"topic\" class=\"w3-input w3-border\" type=\"text\" size=\"36\" value=\"".$row["base_topic"]."\"/>
                </div>\n";
        echo "<div class=\"w3-col m6 s6\">
                    <label>Feed prefix</label>
                    <input name=\"prefix\" class=\"w3-input w3-border\" type=\"text\" size=\"36\" value=\"".$row["prefix"]."\"/>
                </div>\n";
        echo "<div class=\"w3-col m3 s6\">
                    <label>Interval[sec.]</label>
                    <input name=\"interval\" class=\"w3-input w3-border\" type=\"number\" min=\"1\" max=\"60\" value=\"".$row["read_interval"]."\"/>
                </div>\n";
        echo "<div class=\"w3-col m3 s6\">
                    <label>Port</label>
                    <input name=\"port\" class=\"w3-input w3-border\" type=\"number\" min=\"1\" max=\"99999\" value=\"".$row["srv_port"]."\"/>
                </div>\n";
        echo "<div class=\"w3-col m12 s12\">
                        <label>Username</label>
                        <input name=\"username\" class=\"w3-input w3-border\" type=\"text\" value=\"".$row["username"]."\"/>
                    </div>\n";
        echo "<div class=\"w3-col m12 s12\">
                        <label>Password</label>
                        <input name=\"password\" class=\"w3-input w3-border\" type=\"password\"/>
                    </div>";
        echo "<div class=\"w3-col m12 s12\">
                    <label>Enable SSL</label>
                    <br/>\n";
        if ($row["crt_enabled"] == 1) {
            echo "<input type=\"checkbox\" class=\"w3-check\" name=\"crt_enabled\" value=\"1\" checked=\"checked\"/>\n";
        } else {
            echo "<input type=\"checkbox\" class=\"w3-check\" name=\"crt_enabled\" value=\"0\" ".$disabled."/>\n";
        }
        echo "</div>\n";
        echo "</div>
            <br/>";
        echo "<div class=\"w3-row-padding\">
                    <div class=\"w3-col m12 s12\">
                        <input type=\"submit\" name=\"save\" class=\"w3-button w3-block w3-green\" value=\"Save\" />
                    </div>
                </div>\n";
        echo "</form>\n";
        echo "<br/>\n";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
