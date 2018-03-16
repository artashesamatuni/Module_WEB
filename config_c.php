<?php
require 'modules/basic.php';
require 'modules/menu.php';
require 'modules/tzone.php';
require 'modules/connection.php';
require 'modules/tabs.php';

head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>";

$cur = 'Settings';
show_menu($cur);
echo "<div class='w3-main' style='height: 100%; margin-top:48px;margin-bottom:64px;'>";
$t_names = array("Timezone", "Network", "Status");
$cur_tab = $_COOKIE['c_tab'];
draw_tabs($t_names, $cur_tab);
echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">";
if ($cur_tab==0) {
    echo "<div id=\"tab0\" class=\"w3-show\">";
} else {
    echo "<div id=\"tab0\" class=\"w3-hide\">";
}
tzone_config();
echo "</div>";
 if ($cur_tab==1) {
     echo "<div id=\"tab1\" class=\"w3-show\">";
 } else {
     echo "<div id=\"tab1\" class=\"w3-hide\">";
 }
network_config();

echo "</div>";
if ($cur_tab==2) {
    echo "<div id=\"tab2\" class=\"w3-show\">";
} else {
    echo "<div id=\"tab2\" class=\"w3-hide\">";
}



echo "</div>
</div>";
footer();
echo "</body>\n";
echo "</html>";




function tzone_config()
{
    echo "<br/>
    <form>\n";
    echo "<select>\n";
    echo "<option value=\"0\">Please, select timezone</option>\n";
    foreach (tz_list() as $t) {
        echo "<option value=\"".$t['zone']."\">".$t['diff_from_GMT']. " - " . $t['zone']."</option>\n";
    }
    echo "</select>
</form>
<br/>\n";
}

function network_config()
{
    echo "<br/>
        <form action='add_eth.php' method='post'>";
    $conn    = Connect();
    $sql = "SELECT dhcp, ip, mask,gateway,broadcast,nameserver,domain,search FROM network";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $conn->close();

    echo "<input type=\"checkbox\" name=\"dhcp\" class=\"w3-check\" value='".$row ['dhcp']."'/>
    <label>DHCP</label>";
    echo "<div class=\"w3-row-padding\">
            <div class=\"w3-col m4 s12\">
                <label>IP*</label><input type=\"text\" class=\"w3-input w3-border\" name=\"ip\" value='".$row ['ip']."' />
            </div>
            <div class=\"w3-col m4 s12\">
                <label>Netmask*</label><input type=\"text\" class=\"w3-input w3-border\" name=\"mask\" value='".$row ['mask']."' />
            </div>
            <div class=\"w3-col m4 s12\">
                <label>Gateway*</label><input type=\"text\" class=\"w3-input w3-border\" name=\"gateway\" value='".$row ['gateway']."' />
            </div>
        </div>";
    echo "<div class=\"w3-row-padding\">
            <div class=\"w3-col m3 s12\">
                <label>Broadcast</label><input type=\"text\" class=\"w3-input w3-border\" name=\"broadcast\" value='".$row ['broadcast']."' />
            </div>
            <div class=\"w3-col m3 s12\">
                <label>DNS Nameserver</label><input type=\"text\" class=\"w3-input w3-border\" name=\"nameserver\" value='".$row ['nameserver']."' />
            </div>
            <div class=\"w3-col m3 s12\">
                <label>DNS Domain</label><input type=\"text\" class=\"w3-input w3-border\" name=\"domain\" value='".$row ['domain']."' />
            </div>
            <div class=\"w3-col m3 s12\">
                <label>DNS Search</label><input type=\"text\" class=\"w3-input w3-border\" name=\"search\" value='".$row ['search']."' />
            </div>
        </div>";
    echo "<br/><br/>
    <input type='submit' value='Submit'>
   </form>
   <br/>";
}
