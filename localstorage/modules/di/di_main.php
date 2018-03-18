<?php
require '../basic.php';
require '../menu.php';
require '../connection.php';
require '../tabs.php';
head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>\n";
$cur = 'Digital Inputs';
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
    $sql = "SELECT id, name, enabled, polarity FROM di_configs";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($cur_tab==$row["id"]) {
                echo "<div id=\"tab".($row["id"])."\" class=\"w3-show\">\n";
            } else {
                echo "<div id=\"tab".($row["id"])."\" class=\"w3-hide\">\n";
            }
            echo "<br/>\n";
            echo "<form method=\"post\">
                    <p>\n";
            if ($row["enabled"]==1) {
                echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"1\" checked=\"checked\"><label>Enabled</label>\n";
            } else {
                echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"0\"><label>Disabled</label>\n";
            }
            echo "</p>
                  <label>Label</label>\n";
            echo "<input name=\"name\" class=\"w3-input w3-border\" type=\"text\" placeholder=\"e.g. Room temperature\" value=\"".$row["name"]."\" />
                  <p>\n";
            if ($row["polarity"]==1) {
                echo "<input type=\"checkbox\" class=\"w3-check\" name=\"polarity\" value=\"1\" checked=\"checked\"><label>Inverse</label>\n";
            } else {
                echo "<input type=\"checkbox\" class=\"w3-check\" name=\"polarity\" value=\"0\"><label>Normal</label>\n";
            }
            echo "</p>
                  <input type=\"submit\" class=\"w3-button w3-blue w3-card-4\" name=\"insert".$row["id"]."\" value=\"Save\">
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
    if (isset($_POST['polarity'])) {
        $polarity=1;
    } else {
        $polarity=0;
    }
    $conn    = Connect();
    $name       = $conn->real_escape_string($_POST['name']);
    //  $polarity   = $conn->real_escape_string($_POST['polarity']);

    $sql = "UPDATE di_configs SET name = '".$name."', polarity=".$polarity.", enabled=".$enabled." WHERE id = ".$id."";
    if ($conn->query($sql)!=true) {
        echo "ERR: " . $sql . "<br>" . $conn->error;
    } else {
        echo $sql;
    }


    $conn->close();
}