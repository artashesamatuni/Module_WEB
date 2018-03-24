<?php
require_once 'modules/connection.php';
require_once 'modules/basic.php';
require_once 'modules/menu.php';
require_once 'modules/tzone.php';
require_once 'modules/tabs.php';

head();
start_line();

$cur = 'Settings';
show_menu($cur);
echo "<div class='w3-main' style='height: 100%; margin-top:50px;margin-bottom:64px;'>";
$t_names = array("Timezone", "Network", "Status");
if (isset($_COOKIE['c_tab']))
{
    $cur_tab = $_COOKIE['c_tab'];
}
else {
    $cur_tab = 1;
}
draw_tabs($t_names, $cur_tab);
echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">";
if ($cur_tab == 1) {
    echo "<div id=\"tab1\" class=\"w3-show\">";
} else {
    echo "<div id=\"tab1\" class=\"w3-hide\">";
}
tzone_config();
echo "</div>";
 if ($cur_tab == 2) {
     echo "<div id=\"tab2\" class=\"w3-show\">";
 } else {
     echo "<div id=\"tab2\" class=\"w3-hide\">";
 }
network_config();
echo "</div>";
if ($cur_tab == 3) {
    echo "<div id=\"tab3\" class=\"w3-show\">";
} else {
    echo "<div id=\"tab3\" class=\"w3-hide\">";
}
echo "<br/>
        </div>
        <br/>
    </div>\n";

echo "</div>\n</div>";
footer();
end_line();




function tzone_config()
{
    echo "<br/>
    <form method=\"post\" action=\"modules/config/config_save_tzone.php\">";
    $conn = Connect();
    $sql = "SELECT timezone FROM timezone";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $conn->close();
    echo "<div class=\"w3-row-padding\">
            <div class=\"w3-col m12 s12\">
                <label>Timezone</label>
                <select class=\"w3-select w3-border\" name=\"timezone\">\n";
    foreach (tz_list() as $t) {
        echo "<option value=\"".$t['zone']."\"";
        if ($t['zone'] == $row["timezone"]) {
            echo " selected";
        }
        echo ">".$t['zone'];

        echo "</option>\n";
    }
    echo "</select>
        </div>
    </div>
    <br/>";
    echo "<div class=\"w3-row-padding\">
            <div class=\"w3-col m12 s12\">
                    <input type=\"submit\" name=\"save_timezone\" class=\"w3-button w3-block w3-green\" value=\"Save\" />
            </div>
        </div>
    </form>
    <br/>\n";
}

function network_config()
{
    echo "<br/>
          <form method=\"post\" action=\"modules/config/config_save_eth.php\">";
    $conn = Connect();
    $sql = "SELECT id, dhcp, ip, mask,gateway,broadcast,nameserver,domain,search FROM eth_configs";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $conn->close();
    echo "<div class=\"w3-row-padding\">
            <div class=\"w3-col m3 s12\">
            <label>Enable DHCP</label><br/>";
    if ($row["dhcp"] == 1) {
        echo "<input type=\"checkbox\" class=\"w3-check\" name=\"dhcp\" value=\"1\" checked=\"checked\" />";
    } else {
        echo "<input type=\"checkbox\" class=\"w3-check\" name=\"dhcp\" value=\"0\" />";
    }
    echo "</div>
            <div class=\"w3-col m3 s12\">
                <label>IP*</label><input type=\"text\" class=\"w3-input w3-border\" name=\"ip\" value='".$row ['ip']."' />
            </div>
            <div class=\"w3-col m3 s12\">
                <label>Netmask*</label><input type=\"text\" class=\"w3-input w3-border\" name=\"mask\" value='".$row ['mask']."' />
            </div>
            <div class=\"w3-col m3 s12\">
                <label>Gateway*</label><input type=\"text\" class=\"w3-input w3-border\" name=\"gateway\" value='".$row ['gateway']."' />
            </div>
        </div>
        <br/>";
    echo "<div class=\"w3-row-padding\">
            <div class=\"w3-col m3 s12\">
                <label>Broadcast</label><input type=\"text\" class=\"w3-input w3-border\" name=\"broadcast\" value='".$row ['broadcast']."' />
            </div>
            <div class=\"w3-col m3 s12\">
                <label>Nameserver</label><input type=\"text\" class=\"w3-input w3-border\" name=\"nameserver\" value='".$row ['nameserver']."' />
            </div>
            <div class=\"w3-col m3 s12\">
                <label>Domain</label><input type=\"text\" class=\"w3-input w3-border\" name=\"domain\" value='".$row ['domain']."' />
            </div>
            <div class=\"w3-col m3 s12\">
                <label>Search</label><input type=\"text\" class=\"w3-input w3-border\" name=\"search\" value='".$row ['search']."' />
            </div>
        </div>
        <br/>";
    echo "<div class=\"w3-row-padding\">
                <div class=\"w3-col m12 s12\">
                        <input type=\"submit\" class=\"w3-button w3-block w3-green\" value=\"Save\" />
                </div>
            </div>";
    echo "</form>
   <br/>";
}
?>
