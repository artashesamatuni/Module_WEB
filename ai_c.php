<?php
require 'basic.php';
require 'menu.php';
require 'connection.php';
require 'tabs.php';
head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>\n";

$cur = 'Analog Inputs';
show_menu($cur);

echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";

$t_names = array("Channel 0", "Channel 1","Channel 2","Channel 3");
$cur_tab = $_COOKIE['c_tab'];
draw_tabs($t_names, $cur_tab);


echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">\n";
read_config($cur_tab);
echo "</div>
    </div>";
footer(); echo "</div>
</body>\n";
echo "</html>";


function read_config($cur_tab)
{
    $conn    = Connect();
    $sql = "SELECT id, name, enabled, unit, min, max FROM ai_configs";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($cur_tab==$row["id"]) {
                echo "<div id=\"tab".($row["id"])."\" class=\"w3-show\">\n";
            } else {
                echo "<div id=\"tab".($row["id"])."\" class=\"w3-hide\">\n";
            }
            echo "<br/>\n";
            echo $row["enabled"];
            echo "<form method=\"post\">\n";
            if ($row["enabled"]==1) {
                echo "<input name=\"enabled\" type=\"checkbox\" value=\"1\" checked/>&nbsp;Enabled\n";
            } else {
                echo "<input name=\"enabled\" type=\"checkbox\" value=\"0\" />&nbsp;Disabled\n";
            }
            echo "<br/>Label<br/>
                  <input name=\"name\" type=\"text\" placeholder=\"e.g. Room temperature\" value=\"".$row["name"]."\" />
                  <br/>Unit<br/>
                  <input name=\"unit\" type=\"text\" placeholder=\"e.g. &deg;C\" value=\"".$row["unit"]."\" />
                  <br/>Scaling<br/>
                  <sub>min</sub><br/>
                  <input name=\"min\" type=\"number\" placeholder=\"e.g. 0\" value=\"".$row["min"]."\" />
                  <br/><sub>max</sub><br/>
                  <input name=\"max\" type=\"number\" placeholder=\"e.g. 250\" value=\"".$row["max"]."\" />
                  <br/>
                  <br/>
                  <input type=\"submit\" name=\"insert".$row["id"]."\" value=\"Save\">
                  </form>
                  <br/>
                </div>\n";
        }
    }
    $conn->close();
}

if (isset($_POST['insert0'])) {
    save(0);
}
if (isset($_POST['insert1'])) {
    save(1);
}
if (isset($_POST['insert2'])) {
    save(2);
}
if (isset($_POST['insert3'])) {
    save(3);
}


function save($id)
{
    if (isset($_POST['enabled'])) {
        $enabled=1;
    } else {
        $enabled=0;
    }
    $conn    = Connect();
    $name       = $conn->real_escape_string($_POST['name']);
    $unit       = $conn->real_escape_string($_POST['unit']);
    $min        = $conn->real_escape_string($_POST['min']);
    $max        = $conn->real_escape_string($_POST['max']);

    $sql = "UPDATE ai_configs SET name = '".$name."', unit='".$unit."', min=".$min.",max=".$max.",enabled=".$enabled." WHERE id = ".$id."";
    if ($conn->query($sql)!=true) {
        echo "ERR: " . $sql . "<br>" . $conn->error;
    } else {
        echo $sql;
    }
    echo isset($_POST['enabled']);

    $conn->close();
}
