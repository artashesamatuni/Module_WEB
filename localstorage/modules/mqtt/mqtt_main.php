<?php
require '../connection.php';
require '../basic.php';
require '../menu.php';
require '../tabs.php';
session_start();
head();
start_line();
$cur = 'MQTT Settings';
show_menu($cur);
echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";
$t_names = array("Configuration", "Certificates", "Topics");
if (isset($_COOKIE['c_tab']))
{
    $cur_tab = $_COOKIE['c_tab'];
}
else {
    $cur_tab = 1;
}
draw_tabs($t_names, $cur_tab);
read_config($cur_tab);
echo "</div>\n";
footer();
end_line();
cert_upload_modal();


function cert_upload_modal()
{
    echo "<div id=\"upload\" class=\"w3-modal\">
                <div class=\"w3-modal-content\">
                    <span onclick=\"document.getElementById('upload').style.display='none'\" class=\"w3-button w3-light-gray w3-text-red w3-display-topright\"><i class=\"fa fa-close\"></i></span>";
    echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">\n
<h4>Upload Server Certificates</h4>
      <form action=\"mqtt_cert_upload.php\" method=\"post\" enctype=\"multipart/form-data\">
          <label>Certificate</label>
          <br/>
          <input  type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">
          <br/>
          <br/>
          <input class=\"w3-button w3-green\" type=\"submit\" value=\"Upload File\" name=\"submit\">
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
    require_once 'mqtt_topics_load.php';
    echo "</div>\n";
    echo "</div>\n";
}

?>
