<?php
require '../basic.php';
require '../menu.php';
require '../connection.php';
require '../tabs.php';
head();
start_line();
$cur = 'Analog Inputs';
show_menu($cur);
echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";
$t_names = array("Channel 0", "Channel 1","Channel 2","Channel 3");
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


function read_config($cur_tab)
{
    echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">\n";
    $conn    = Connect();
    $sql = "SELECT id, name, enabled, unit, min, max FROM ai_configs";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($cur_tab==$row["id"]) {
                echo "<div id=\"tab".($row["id"])."\" class=\"w3-container w3-show\">\n";
            } else {
                echo "<div id=\"tab".($row["id"])."\" class=\"w3-container w3-hide\">\n";
            }
            echo "<br/>\n";
            echo "<form method=\"post\">
            <div class=\"w3-row-padding\">
                <div class=\"w3-col m2 s2\">
                    <label>Enable</label>
                    <br/>";
            if ($row["enabled"]==1) {
                echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"1\" checked=\"checked\" />";
            } else {
                echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"0\" />";
            }
            echo "</div>\n";
            echo "<div class=\"w3-col m10 s10\">
                    <label>Name</label>
                    <input name=\"name\" class=\"w3-input w3-border\" type=\"text\" placeholder=\"e.g. Room temperature\" value=\"".$row["name"]."\" />
                  </div>
                  </div>\n";
            echo "<div class=\"w3-row-padding\">
                    <div class=\"w3-col m4 s4\">
                      <label>Unit</label>
                      <input name=\"unit\" class=\"w3-input w3-border\" type=\"text\" placeholder=\"e.g. Room temperature\" value=\"".$row["unit"]."\" />
                    </div>\n";
            echo "<div class=\"w3-col m4 s4\">
                          <label>Min</label>
                          <input name=\"min\" class=\"w3-input w3-border\" type=\"number\" step=\"any\" placeholder=\"e.g. 0\" value=\"".$row["min"]."\" />
                    </div>\n";
            echo "<div class=\"w3-col m4 s4\">
                                  <label>Max</label>
                                  <input name=\"max\" class=\"w3-input w3-border\" type=\"number\" step=\"any\" placeholder=\"e.g. 0\" value=\"".$row["max"]."\" />
                            </div>\n";
            echo "</div>
                  <br/>";
            echo "<div class=\"w3-row-padding\">
                    <div class=\"w3-col m12 s12\">
                            <input type=\"submit\" name=\"insert".$row["id"]."\" class=\"w3-button w3-block w3-green\" value=\"Save\" />
                    </div>
                </div>";
            echo "</form>
                  <br/>
                  </div>\n";
        }
    }
    $conn->close();
    echo "</div>";
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
if (isset($_POST['insert4'])) {
    save(4);
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
        snackbar("Done");
    }

    $conn->close();
}
?>
