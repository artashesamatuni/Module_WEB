<?php
require_once 'modules/basic.php';
require_once 'modules/menu.php';
require_once 'modules/connection.php';
require_once 'modules/tabs.php';
head();
start_line();
$cur = 'Digital Outputs';
show_menu($cur);
echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:50px;margin-bottom:64px;\">\n";
$t_names = array("Relay 0", "Relay 1","Relay 2","Relay 3");
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
    $sql = "SELECT id, name, enabled, polarity, mode FROM rl_configs";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($cur_tab==$row["id"]) {
                echo "<div id=\"tab".($row["id"])."\" class=\"w3-container w3-show\">\n";
            } else {
                echo "<div id=\"tab".($row["id"])."\" class=\"w3-container w3-hide\">\n";
            }
            echo "<br/>\n";
            echo "<form method=\"post\" action=\"modules/do/do_save.php\">
            <input name=\"id\" type=\"hidden\" value=\"".($row["id"])."\">
                    <input name=\"id\" type=\"hidden\" value=\"".$row["id"]."\" />
                    <div class=\"w3-row-padding\">
                        <div class=\"w3-col m2 s2\">
                            <label>Enable</label>
                            <br/>";
                            if ($row["enabled"]==1) {
                                echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"1\" checked=\"checked\" />";
                            } else {
                                echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"0\" />";
                            }
                    echo "</div>
                    <div class=\"w3-col m2 s2\">
                        <label>Polarity</label>
                        <br/>";
                        if ($row["polarity"]==1) {
                            echo "<input type=\"checkbox\" class=\"w3-check\" name=\"polarity\" value=\"1\" checked=\"checked\" />";
                        } else {
                            echo "<input type=\"checkbox\" class=\"w3-check\" name=\"polarity\" value=\"0\" />";
                        }
                echo "</div>\n";
                    echo "<div class=\"w3-col m5 s5\">
                            <label>Name</label>
                            <input name=\"name\" class=\"w3-input w3-border\" type=\"text\" placeholder=\"e.g. Room temperature\" value=\"".$row["name"]."\" />
                          </div>\n";
                    echo "<div class=\"w3-col m3 s3\">";
                            require_once 'modules/do/do_modes.php';
                    echo "</div>
                    </div>
                    <br/>\n";
                    echo "<div class=\"w3-row-padding\">
                            <div class=\"w3-col m6 s6\">";
                                    require_once 'modules/do/do_operators.php';
                    echo "</div>
                            <div class=\"w3-col m6 s6\">";
                            require_once 'modules/do/do_sources.php';
                            echo "</div>
                        </div>
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
    echo "</div>\n";
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

    $sql = "UPDATE rl_configs SET name = '".$name."', polarity=".$polarity.", enabled=".$enabled." WHERE id = ".$id."";
    if ($conn->query($sql)!=true) {
        echo "ERR: " . $sql . "<br>" . $conn->error;
    } else {
        snackbar("Done");
    }
    $conn->close();
}
?>
