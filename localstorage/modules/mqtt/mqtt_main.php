<?php
require '../connection.php';
require '../basic.php';
require '../menu.php';
require '../tabs.php';

head();
$cur = 'MQTT Settings';
show_menu($cur);
echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";
$t_names = array("MQTT Server Config", "MQTT Certificates", "MQTT Channels Topics");
$cur_tab = $_COOKIE['c_tab'];
draw_tabs($t_names, $cur_tab);
read_config($cur_tab);
echo "</div>\n";
footer();
cert_upload_modal();


function cert_upload_modal()
{

    echo "<div id=\"upload\" class=\"w3-modal\">
                <div class=\"w3-modal-content\">
                    <button class=\"w3-button w3-right w3-red w3-display-topright\" onclick=\"document.getElementById('upload').style.display='none'\">&times;</button>";
    echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">\n
      <h4>Upload Server Certificates</h4>
      <form action=\"mqtt_cert_upload.php\" method=\"post\" enctype=\"multipart/form-data\">
                      Certificate<br/>
                      <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">
                      <input type=\"submit\" value=\"Upload File\" name=\"submit\">
                  </form>
          <br/>
          </div>\n";
    echo "</div>
          </div>\n";
}


function read_config($cur_tab)
{
    echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">\n";
    if ($cur_tab == 1) {
        echo "<div id=\"tab1\" class=\"w3-container w3-show\">\n";
    } else {
        echo "<div id=\"tab1\" class=\"w3-container w3-hide\">\n";
    }
    require_once 'mqtt_config_load.php';
    echo "</div>\n";

    if ($cur_tab == 2) {
        echo "<div id=\"tab2\" class=\"w3-container w3-show\">\n";
    } else {
        echo "<div id=\"tab2\" class=\"w3-container w3-hide\">\n";
    }
    require_once 'mqtt_certs_load.php';
    echo "</div>\n";



    if ($cur_tab == 3) {
        echo "<div id=\"tab3\" class=\"w3-container w3-show\">\n";
    } else {
        echo "<div id=\"tab3\" class=\"w3-container w3-hide\">\n";
    }
    show_list();
    echo "</div>\n";

    echo "</div>\n";
}




function show_list()
{
    echo "<br/>";
    $conn = Connect();
    echo "<table class=\"w3-table w3-border\">
                <tr>
                    <td><b>Name</b></td>
                    <td><b>Topic</b></td>
                </tr>\n";
    $sql = "SELECT id, topic_name, topic FROM mqtt_topics";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<tbody>\n";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["topic_name"]."</td>
                    <td>".$row["topic"]."</td>
                </tr>\n";
        }
        echo "</tbody>\n";
    }
    echo "</table>";
    echo "<br/>";
    $sql = "SELECT mqtt_conn FROM dev_status";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<footer class=\"w3-center ";
            if ($row["mqtt_conn"]) {
                echo "w3-green\">Connected";
            } else {
                echo "w3-red\">-----";
            }
            echo "</footer>";
        }
    }
    $conn->close();
    echo "<br/>";
}
