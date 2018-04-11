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
if (isset($_COOKIE['c_tab'])) {
    $cur_tab = $_COOKIE['c_tab'];
} else {
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
    $conn = Connect();
    $sql = "SELECT id, name, enabled, polarity, mode FROM rl_configs";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($cur_tab == $row["id"]) {
                echo "<div id=\"tab".($row["id"])."\" class=\"w3-container w3-show\">\n";
            } else {
                echo "<div id=\"tab".($row["id"])."\" class=\"w3-container w3-hide\">\n";
            }
            echo "<br/>\n";
            $row["id"];
            echo "<br/>\n";
            echo "<form method=\"post\" action=\"modules/do/do_save.php\">
            <input name=\"id\" type=\"hidden\" value=\"".($row["id"])."\">
                    <input name=\"id\" type=\"hidden\" value=\"".$row["id"]."\" />
                    <div class=\"w3-row-padding\">
                        <div class=\"w3-col m2 s2\">
                            <label>Enable</label>
                            <br/>";
            if ($row["enabled"] == 1) {
                echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"1\" checked=\"checked\" />";
            } else {
                echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"0\" />";
            }
            echo "</div>
                    <div class=\"w3-col m2 s2\">
                        <label>Polarity</label>
                        <br/>";
            if ($row["polarity"] == 1) {
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
            do_modes($row["mode"]);
            echo "</div>
                    </div>
                    <br/>\n";
            if ($row["mode"] == 2) {
                $conn = Connect();
                //rl_input_settings id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, source TEXT, channel TINYINT, operator TEXT, value REAL, on_delay INT, off_delay INT
                $sql = "SELECT source, channel, operator, value, on_delay, off_delay FROM rl_input_settings WHERE id=".$row["id"]."";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row1 = $result->fetch_assoc()) {
                        echo "<div class=\"w3-row-padding\">
                                <div class=\"w3-col m4 s4\">\n";
                        do_sources($row1["source"]);
                        echo "</div>
                                <div class=\"w3-col m4 s4\">\n";
                        do_node($row1["source"], $row1["channel"]);
                        echo "</div>
                                <div class=\"w3-col m4 s4\">\n";
                        do_operators($row1["operator"]);
                        echo "</div>
                              <div class=\"w3-col m4 s4\">
                                <label>Value</label>
                                <input name=\"value\" class=\"w3-input w3-border\" type=\"number\" step=\"any\" value=\"".$row1["value"]."\" />
                              </div>
                              <div class=\"w3-col m4 s4\">
                              <label>On delay(sec.)</label>
                              <input name=\"on_delay\" class=\"w3-input w3-border\" type=\"number\" value=\"".$row1["on_delay"]."\" /></div>
                              <div class=\"w3-col m4 s4\">
                              <label>Off delay(sec.)</label>
                              <input name=\"off_delay\" class=\"w3-input w3-border\" type=\"number\" value=\"".$row1["off_delay"]."\" /></div>
                            </div>
                            <br/>";
                    }
                }
                $conn->close();
            }
            if ($row["mode"] == 3) {
                echo "<div class=\"w3-row-padding\">
                        <div class=\"w3-col m6 s6\">\n";
                do_timer($row["id"], "on");
                echo "</div>
                        <div class=\"w3-col m6 s6\">\n";
                do_timer($row["id"], "off");
                echo "</div>
                    </div>
                    <br/>";
            }


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

function do_modes($mode)
{
    $conn = Connect();
    $sql = "SELECT name FROM rl_modes WHERE id=".$mode."";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sel = $row["name"];
    }
    echo "<label>Modes</label>
          <select name=\"mode\" class=\"w3-select\">\n";
    $sql = "SELECT id,name FROM rl_modes";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        while ($row_mod = $result->fetch_assoc()) {
            if ($row_mod["name"] == $sel) {
                echo "<option value=\"".$row_mod["id"]."\" selected>".$row_mod["name"]."</option>\n";
            } else {
                echo "<option value=\"".$row_mod["id"]."\">".$row_mod["name"]."</option>\n";
            }
        }
    }
    echo "</select>\n";
}

function do_operators($src)
{
    echo "<label>Function</label>
          <select name=\"operator\" class=\"w3-select\">\n";
    $conn = Connect();
    $sql = "SELECT id,name FROM rl_operators";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        while ($row_op = $result->fetch_assoc()) {
            if ($row_op["id"] == $src) {
                echo "<option value=\"".$row_op["id"]."\" selected>".$row_op["name"]."</option>\n";
            } else {
                echo "<option value=\"".$row_op["id"]."\">".$row_op["name"]."</option>\n";
            }
        }
    }
    echo "</select>\n";
}

function do_sources($src)
{
    echo "<label>Sources</label>
          <select name=\"source\" class=\"w3-select\">\n";
    $conn = Connect();
    $sql = "SELECT id,name FROM rl_sources";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        while ($row_src = $result->fetch_assoc()) {
            if ($row_src["id"] == $src) {
                echo "<option value=\"".$row_src["id"]."\" selected>".$row_src["name"]."</option>\n";
            } else {
                echo "<option value=\"".$row_src["id"]."\">".$row_src["name"]."</option>\n";
            }
        }
    }
    echo "</select>\n";
}
function do_node($type, $src)
{
    echo "<label>Channel</label>
          <select name=\"channel\" class=\"w3-select\">\n";
    $conn = Connect();
    if ($type == 1) {
        $sql = "SELECT id,name FROM ai_configs";
    }
    if ($type == 2) {
        $sql = "SELECT id,name FROM di_configs";
    }
    if ($type == 3) {
        $sql = "SELECT id,name FROM mbus_nods";
    }
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["id"] == $src) {
                echo "<option value=\"".$row["id"]."\" selected>".$row["name"]."</option>\n";
            } else {
                echo "<option value=\"".$row["id"]."\">".$row["name"]."</option>\n";
            }
        }
    }
    echo "</select>\n";
}


function do_timer($id, $fn)
{
    $conn = Connect();
    $sql = "SELECT id,on_duration,off_duration FROM rl_time_settings WHERE id=".$id."";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        while ($row_tm = $result->fetch_assoc()) {
            if ($fn == "on") {
                echo "<label>On duration</label>
                  <input name=\"on\" class=\"w3-input w3-border\" type=\"number\" value=\"".$row_tm["on_duration"]."\">\n";
            }
            if ($fn == "off") {
                echo "<label>Off duration</label>
                      <input name=\"off\" class=\"w3-input w3-border\" type=\"number\" value=\"".$row_tm["off_duration"]."\">\n";
            }
        }
    }
}
?>
