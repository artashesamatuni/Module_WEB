<?php
require 'basic.php';
require 'menu.php';
require 'tzone.php';
require 'connection.php';
require 'tabs.php';

head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>";
echo "<div>";

$cur = 'Settings';
show_menu($cur);
echo "<div class='w3-main' style='height: 100%; margin-top:48px;margin-bottom:64px;'>";
echo "<div class='w3-panel'>";
$t_names = array("System", "Network", "Status");

draw_tabs($t_names,0);


echo "<div class='w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray'>";
//------------------------------------------------------------------------------------------------------------------------------
echo "<div id=\"tab0\" class=\"w3-show\">\n<br/>\n<div class=\"w3-row\">\n";
echo "<div class=\"w3-col w3-container m12 s12\">\n<h4 class=\"w3-container w3-center\">Your Timezone</h4>\n<form>\n";
                          echo "<select>\n";
                          echo "<option value=\"0\">Please, select timezone</option>\n";
                            foreach(tz_list() as $t) {
                              echo "<option value=\"".$t['zone']."\">".$t['diff_from_GMT']. " - " . $t['zone']."</option>\n";
                            }
                          echo "</select>\n</form>\n<br/>\n";
echo "</div>\n</div>\n<br/>\n</div>\n";
//------------------------------------------------------------------------------------------------------------------------------
echo "<div id=\"tab1\" class=\"w3-hide\">
        <div class='w3-row'>
            <div class='w3-col w3-container m12 s12'>
                <h4 class='w3-container w3-center'>Ethernet Configuration</h4>";
                    $conn    = Connect();
                    $sql = "SELECT dhcp, ip, mask,gateway,broadcast,nameserver,domain,search FROM network";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $conn->close();
                echo "<form action='add_eth.php' method='post'>\n
                <input type='checkbox' name='dhcp' value='".$row ['dhcp']."'/>DHCP
                    <br/>IP*<br/><input type='text' name='ip' value='".$row ['ip']."' />
                    <br/>Netmask*<br/><input type='text' name='mask' value='".$row ['mask']."' />
                    <br/>Gateway*<br/><input type='text' name='gateway' value='".$row ['gateway']."' />
                    <br/>Broadcast<br/><input type='text' name='broadcast' value='".$row ['broadcast']."' />
                    <br/>DNS Nameserver<br/><input type='text' name='nameserver' value='".$row ['nameserver']."' />
                    <br/>DNS Domain<br/><input type='text' name='domain' value='".$row ['domain']."' />
                    <br/>DNS Search<br/><input type='text' name='search' value='".$row ['search']."' />
                    <br/><br/>
                    <input type='submit' value='Submit'>
                </form>
            </div>
            </div>
            <br/>
        </div>";
//------------------------------------------------------------------------------------------------------------------------------
echo "<div id=\"tab2\" class=\"w3-hide\">
        <br/>

        3

        <br/>
    </div>";
//------------------------------------------------------------------------------------------------------------------------------
echo "</div>
    </div>
</div>
</div>";
footer();
echo "</div>
</body>

    <script src=\"lib.js\" type=\"text/javascript\"></script>
    <script src=\"config.js\" type=\"text/javascript\"></script>
</html>";
?>
