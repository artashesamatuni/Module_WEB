<?php
require 'modules/connection.php';
require 'modules/basic.php';
require 'modules/menu.php';
require 'modules/tabs.php';

$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=$url1");

head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>";
echo "<div>";

$cur = 'Access control';
show_menu($cur);
echo "<div class='w3-main' style='height: 100%; margin-top:48px;margin-bottom:64px;'>";
$t_names = array("Access control");
$cur_tab = 0;
draw_tabs($t_names, $cur_tab);
echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">";
if ($cur_tab==0) {
    echo "<div id=\"tab0\" class=\"w3-show\">";
} else {
    echo "<div id=\"tab0\" class=\"w3-hide\">";
}
read_config();
echo "</div>
 <br/>
</div>
</div>\n</div>";
footer();
echo "</body>\n";
echo "</html>";

function read_config()
{
    $conn    = Connect();
    $sql = "SELECT login, password FROM log_pass";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<br/>\n";
            echo "<form method=\"post\">
                    <div class=\"w3-row-padding\">
                        <label>Username</label><input name=\"login\" class=\"w3-input w3-border\" type=\"text\" value=\"".$row["name"]."\" />
                    </div>
                    <br/>
                    <div class=\"w3-row-padding\">
                        <label>Password</label><input name=\"password\" class=\"w3-input w3-border\" type=\"text\" value=\"".$row["password"]."\" />
                    </div>";
            echo "<div class=\"w3-right\">
                        <input type=\"submit\" class=\"w3-button w3-gray w3-text-white w3-card-4\" name=\"insert".$row["id"]."\" value=\"Save\" />
                    </div>
            </div>\n";


            echo "</form>
                <br/>\n";
        }
    }
    $conn->close();
}
