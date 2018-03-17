<?php
require '../connection.php';
require '../basic.php';
require '../menu.php';
require '../tabs.php';

head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>\n";
echo "<div>\n";

$cur = 'MQTT Settings';
show_menu($cur);

echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";

$t_names = array("MQTT Reports Config", "MQTT Channels Topics");
$cur_tab = $_COOKIE['c_tab'];
draw_tabs($t_names, $cur_tab);

echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">";
if ($cur_tab==0) {
    echo "<div id=\"tab0\" class=\"w3-show\">\n";
} else {
    echo "<div id=\"tab0\" class=\"w3-hide\">\n";
}
config();
echo "</div>";
if ($cur_tab==1) {
    echo "<div id=\"tab1\" class=\"w3-show\">\n";
} else {
    echo "<div id=\"tab1\" class=\"w3-hide\">\n";
}
show_list();
echo "<br/>
        </div>
        <br/>
    </div>\n";

echo "</div>\n</div>\n</div>";
footer();
echo "</body>\n";
echo "</html>";


function config()
{
    $conn    = Connect();
    echo "<br/>
          <form method=\"post\" action=\"save_mqtt.php\">";
    $mqtt_sql = "SELECT enabled, srv_addr, srv_port, base_topic, crt_enabled, username, password, read_interval, crt_name, key_name, ca_name FROM mqtt_configs";
    $mqtt_result = $conn->query($mqtt_sql);
    if ($mqtt_result->num_rows > 0) {
        while ($mqtt_row = $mqtt_result->fetch_assoc()) {
            echo "<br/>".$mqtt_row["enabled"]."<br/>
                <input type=\"hidden\" name=\"enabled\" value=\"0\" />
                <input name=\"enabled\" type=\"checkbox\" value=\"";
            if ($mqtt_row["enabled"]==0) {
                echo "0\"/>Disabled<br/>\n";
            } else {
                echo "1\" checked/>Enabled<br/>\n";
            }
            echo "<br/>MQTT Server*<br/>
                <input name=\"srv_addr\" type=\"text\" size=\"36\" placeholder=\"e.g. test.mosquitto.org\" value=\"".$mqtt_row["srv_addr"]."\" />
                <br/>MQTT Base-topic*<br/>
                <input name=\"srv_port\" type=\"text\" size=\"36\" value=\"".$mqtt_row["base_topic"]."\" />
                <br/>MQTT Feed-name prefix<br/>
                <input type=\"text\" />
                <br/>Interval[sec.]<br/>
                <input type=\"number\" min=\"1\" max=\"60\" value=\"".$mqtt_row["read_interval"]."\" />
                <br/>Port<br/>
                <input type=\"number\" min=\"1\" max=\"99999\" value=\"".$mqtt_row["srv_port"]."\" />
                <br/>
                <br/>
                <input id=\"ssl\" type=\"checkbox\"  />".$mqtt_row["crt_enabled"]."
                <input type=\"submit\" value=\"Submit\" />";
            if ($mqtt_row["crt_enabled"]==1) {
                echo "</form><form method=\"POST\" target=\"_blank\" action=\"/mqttcert\" enctype=\"multipart/form-data\">
                                Certificate<br/>
                                <input type=\"file\" name=\"mqttcert\" />
                                <input type=\"submit\" value=\"Upload\" />
                            </form>
                            <form method=\"POST\" target=\"_blank\" action=\"/mqttkey\" enctype=\"multipart/form-data\">
                                Key<br/>
                                <input type=\"file\" name=\"mqttkey\" />
                                <input type=\"submit\" value=\"Upload\" />
                            </form>
                            <form method=\"POST\" target=\"_blank\" action=\"/mqttca\" enctype=\"multipart/form-data\">
                                Certificate CA<br/>
                                <input type=\"file\" name=\"mqttca\" />
                                <input type=\"submit\" value=\"Upload\" accept=\".crt\" />
                            </form>";
            } else {
                echo "<br/>Username<br/>
                      <input name=\"username\" type=\"text\" value=\"".$mqtt_row["username"]."\" />
                      <br/>Password<br/>
                      <input name=\"password\" type=\"password\" value=\"".$mqtt_row["password"]."\"/>
                    </form>";
            }
            echo "<br/>\n";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
}


function show_list()
{
    $conn    = Connect();
    echo "<div class=\"w3-container\">
            <table>
                <tr>
                    <td><b>#</b></td>
                    <td><b>Name</b></td>
                    <td><b>Topic</b></td>
                </tr>";


    $sql = "SELECT id, topic_name, topic FROM mqtt_topics";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<tbody>\n";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>\n<td>".$row["id"]."</td>\n<td>".$row["topic_name"]."</td>\n<td>".$row["topic"]."</td>\n</tr>\n";
        }
        echo "</tbody>\n";

        echo "</table>
            <footer class=\"w3-center w3-text-white\" data-bind=\"style: { 'background-color': status.mqtt_status() ? '#4CAF50' : '#f44336' }\">
                <snap data-bind=\"text: 'MQTT Conection status: '+(status.mqtt_status()?'Connected':'-----')\"></snap>
            </footer>
        </div>\n";
    }
    $conn->close();
}
