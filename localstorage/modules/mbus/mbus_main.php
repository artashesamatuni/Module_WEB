<?php
require '../connection.php';
require '../basic.php';
require '../menu.php';
require '../tabs.php';


head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>\n";

$cur = 'Modbus Settings';
show_menu($cur);

echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";

$t_names = array("Modbus-RTU", "Channels");
$cur_tab = $_COOKIE['c_tab'];
draw_tabs($t_names, $cur_tab);

echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">";
if ($cur_tab==0) {
    echo "<div id=\"tab0\" class=\"w3-show\">";
} else {
    echo "<div id=\"tab0\" class=\"w3-hide\">";
}
       mbus_config();
      echo "</div>";
      if ($cur_tab==1) {
          echo "<div id=\"tab1\" class=\"w3-show\">";
      } else {
          echo "<div id=\"tab1\" class=\"w3-hide\">";
      }
      require 'mbus_show_nodes.php';
            //modbus_show_nodes();
            echo "<button onclick=\"document.getElementById('add').style.display='block'\" class=\"w3-btn w3-blue w3-card-4\">Add</button>
            <br/>
        </div>
        <br/>
    </div>
</div>\n</div>";
new_node_modal();
footer();
echo "</body>
</html>";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
function mbus_config()
{
    $conn    = Connect();
    echo "<br/>
          <form method=\"post\" action=\"mbus_save.php\">";
    $mbus_sql = "SELECT enabled, baud_rate, parity, stop_bits,data_bits,read_interval,read_timeout FROM mbus_configs";
    $mbus_result = $conn->query($mbus_sql);
    if ($mbus_result->num_rows > 0) {
        while ($mbus_row = $mbus_result->fetch_assoc()) {
            echo "<hr/>";
            echo $mbus_row["enabled"];
            echo $mbus_row["baud_rate"];
            echo "<hr/>";
            echo "<div class=\"w3-row-padding\">
                    <div class=\"w3-col m1 s4\">
                        <label>Enable</label>
                        <br/>";
            if ($mbus_row["enabled"]==1) {
                echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"1\" checked=\"checked\"/>\n";
            } else {
                echo "<input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"0\" />\n";
            }
            echo "</div>
                    <div class=\"w3-col m2 s4\">
                        <label>Baudrate</label>
                            <select name=\"baud_rate\" class=\"w3-select\" value=\"".$mbus_row["baud_rate"]."\">\n";
            $baud_rates_sql = "SELECT id,baud_rates FROM mbus_baud_rates";
            $baud_rates_result = $conn->query($baud_rates_sql);

            if ($baud_rates_result->num_rows > 0) {
                while ($baud_rates_row = $baud_rates_result->fetch_assoc()) {
                    if ($mbus_row["baud_rate"]==$baud_rates_row["baud_rates"]) {
                        echo "<option value=\"".$baud_rates_row["baud_rates"]."\" selected>".$baud_rates_row["baud_rates"]."</option>\n";
                    } else {
                        echo "<option value=\"".$baud_rates_row["baud_rates"]."\">".$baud_rates_row["baud_rates"]."</option>\n";
                    }
                }
            } else {
                echo "0 results";
            }
            echo "</select>
                </div>";
            echo "<div class=\"w3-col m2 s4\">
                    <label>Parity</label>
                    <select name=\"parity\" class=\"w3-select\" value=\"".$mbus_row["parity"]."\">";
            $parity_sql = "SELECT id,parity FROM mbus_parity";
            $parity_result = $conn->query($parity_sql);

            if ($parity_result->num_rows > 0) {
                while ($parity_row = $parity_result->fetch_assoc()) {
                    if ($mbus_row["parity"]==$parity_row["parity"]) {
                        echo "<option value=\"".$parity_row["parity"]."\" selected>".$parity_row["parity"]."</option>\n";
                    } else {
                        echo "<option value=\"".$parity_row["parity"]."\">".$parity_row["parity"]."</option>\n";
                    }
                }
            } else {
                echo "0 results";
            }
            echo "</select>
                </div>\n";
            echo "<div class=\"w3-col m1 s3\">
                    <label>StopBits</label>
                    <select name=\"stop_bits\" class=\"w3-select\" value=\"".$mbus_row["stop_bits"]."\">";
            $stop_bits_sql = "SELECT id, stop_bits FROM mbus_stop_bits";
            $stop_bits_result = $conn->query($stop_bits_sql);

            if ($stop_bits_result->num_rows > 0) {
                while ($stop_bits_row = $stop_bits_result->fetch_assoc()) {
                    if ($mbus_row["stop_bits"]==$stop_bits_row["stop_bits"]) {
                        echo "<option value=\"".$stop_bits_row["stop_bits"]."\" selected>".$stop_bits_row["stop_bits"]."</option>\n";
                    } else {
                        echo "<option value=\"".$stop_bits_row["stop_bits"]."\">".$stop_bits_row["stop_bits"]."</option>\n";
                    }
                }
            } else {
                echo "0 results";
            }
            echo "</select>
                </div>\n";
            echo "<div class=\"w3-col m1 s3\">
                    <label>DataBits</label>
                    <select name=\"data_bits\" class=\"w3-select\" value=\"".$mbus_row["data_bits"]."\">";
            $data_bits_sql = "SELECT id, data_bits FROM mbus_data_bits";
            $data_bits_result = $conn->query($data_bits_sql);

            if ($data_bits_result->num_rows > 0) {
                while ($data_bits_row = $data_bits_result->fetch_assoc()) {
                    if ($mbus_row["data_bits"]==$data_bits_row["data_bits"]) {
                        echo "<option value=\"".$data_bits_row["data_bits"]."\" selected>".$data_bits_row["data_bits"]."</option>\n";
                    } else {
                        echo "<option value=\"".$data_bits_row["data_bits"]."\">".$data_bits_row["data_bits"]."</option>\n";
                    }
                }
            } else {
                echo "0 results";
            }
            echo "</select>
                </div>\n";
            echo "<div class=\"w3-col m2 s3\">
                    <label>Timeout[sec.]</label>
                    <input name=\"read_timeout\" class=\"w3-input w3-border\" type=\"number\" min=\"1\" max=\"5\" value=\"".$mbus_row["read_timeout"]."\" />
                  </div>";
            echo "<div class=\"w3-col m2 s3\">
                    <label>Interval[sec.]</label>
                    <input name=\"read_interval\" class=\"w3-input w3-border\" type=\"number\" min=\"1\" max=\"300\" value=\"".$mbus_row["read_interval"]."\" />
                </div>\n";
            echo "</div>";
            echo "<div class=\"w3-row-padding\">
            <div class=\"w3-right\">
                    <input type=\"submit\" class=\"w3-button w3-gray w3-text-white w3-card-4\" value=\"Save\" />
                </div>
            </div>";
            echo "</form>
              <br/>\n";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
}
/*
function show_nodes()
{
    $conn    = Connect();
    echo "<br/>\n";
    echo "<form method=\"post\">\n";
    echo "<table class=\"w3-table w3-border\">
        <tr class=\"w3-blue\">
          <th>#</th>
          <th>Name</th>
          <th>Dev. addr.</th>
          <th>Reg. addr.</th>
          <th>Reg. type</th>
          <th>Unit</th>
          <th>Slope</th>
          <th>Offset</th>
          <th>32 bit</th>
          <th>IEEE754</th>
          <th>Low First</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>\n";

    $sql = "SELECT id, name, dev_addr, reg_addr,reg_type,unit,slope,offset,bit32,ieee754,low_first FROM mbus_nods";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<tbody>\n";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>\n";
            echo "<td>".$row["id"]."</td>\n";
            echo "<td>".$row["name"]."</td>\n";
            echo "<td>".$row["dev_addr"]."</td>\n";
            echo "<td>".$row["reg_addr"]."</td>\n";
            $sql = "SELECT reg_types FROM mbus_reg_types WHERE id=2";//".$row["reg_type"]."\"";
            $reg_types_result = $conn->query($sql);
            $row1 = $reg_types_result->fetch_assoc();

            echo "<td>".$row1["reg_types"]."</td>\n";
            echo "<td>".$row["unit"]."</td>\n";
            echo "<td>".$row["slope"]."</td>\n";
            echo "<td>".$row["offset"]."</td>\n";
            if ($row["bit32"]) {
                echo "<td><input type=\"checkbox\" class=\"w3-check\" checked=\"checked\" disabled/></td>\n";
            } else {
                echo "<td><input type=\"checkbox\" class=\"w3-check\" disabled/></td>\n";
            }
            if ($row["ieee754"]) {
                echo "<td><input type=\"checkbox\" class=\"w3-check\" checked=\"checked\" disabled/></td>\n";
            } else {
                echo "<td><input type=\"checkbox\" class=\"w3-check\" disabled/></td>\n";
            }
            if ($row["low_first"]) {
                echo "<td><input type=\"checkbox\" class=\"w3-check\" checked=\"checked\" disabled/></td>\n";
            } else {
                echo "<td><input type=\"checkbox\" class=\"w3-check\" disabled/></td>\n";
            }
            echo "<td><input type=\"submit\" name=\"edit".$row["id"]."\" class=\"w3-button w3-right w3-gray w3-text-white w3-card-4\" value=\"Edit\"/></td>\n";
            echo "<td><input type=\"submit\" name=\"delete".$row["id"]."\" class=\"w3-button w3-right w3-red w3-card-4\" value=\"&times;\"/></td>\n";
            echo "</tr>\n";
        }
        echo "</tbody>\n";
    } else {
        echo "No data";
    }
    echo "</table>\n";
    echo "</form>
      <br/>\n";
    $conn->close();
}
*/

function new_node_modal()
{
    echo "<div id=\"add\" class=\"w3-modal\">
                <div class=\"w3-modal-content\">
                    <button class=\"w3-button w3-right w3-red w3-display-topright\" onclick=\"document.getElementById('add').style.display='none'\">&times;</button>";
    echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">\n
      <h4>Add new Modbus unit</h4>
      <form method=\"post\" action=\"mbus_new_node.php\">
      <div class=\"w3-row-padding\">";
    echo "<div class=\"w3-col m4 s4\">
              <label>Name</label>
              <input type=\"text\" class=\"w3-input w3-border\" max=\"10\" name=\"name\" />
          </div>";
    echo "<div class=\"w3-col m4 s4\">
              <label>Device addr.</label>
              <input type=\"number\" class=\"w3-input w3-border\" name=\"dev_addr\" />
          </div>";
    echo "<div class=\"w3-col m4 s4\">
              <label>Register addr.</label>
              <input type=\"number\" class=\"w3-input w3-border\" name=\"reg_addr\" />
          </div>";
    echo "</div>
          <div class=\"w3-row-padding\">";
    echo "<div class=\"w3-col m3 s3\">
          <label>Register type</label>\n";
    $conn    = Connect();
    $reg_types_sql = "SELECT id, reg_types FROM mbus_reg_types";
    $reg_types_result = $conn->query($reg_types_sql);

    if ($reg_types_result->num_rows > 0) {
        echo "<select name=\"reg_type\" class=\"w3-select w3-border\">";
        while ($reg_types_row = $reg_types_result->fetch_assoc()) {
            echo "<option value=\"".$reg_types_row["id"]."\">".$reg_types_row["reg_types"]."</option>";
        }
        echo "</select>\n";
    } else {
        echo "No result";
    }
    $conn->close();
    echo "</div>
          <div class=\"w3-col m3 s3\">";
    echo "<label>Unit</label>
          <input type=\"text\" class=\"w3-input w3-border\" name=\"unit\" />
          </div>";
    echo "<div class=\"w3-col m3 s3\">
          <label>Slope</label>
          <input type=\"number\" class=\"w3-input w3-border\" name=\"slope\" value=\"1\" />
          </div>";
    echo "<div class=\"w3-col m3 s3\">
          <label>Offset</label>
          <input type=\"number\" class=\"w3-input w3-border\" name=\"offset\" value=\"0\" />
          </div>";
    echo "</div>
          <div class=\"w3-row-padding\">";
    echo "<div class=\"w3-col m4 s4\">
          <label>32 bit Enable</label>
          <br/>
          <input type=\"checkbox\" class=\"w3-check\" name=\"bit32\" value=\"0\" checked=\"checked\">
          </div>";
    echo "<div class=\"w3-col m4 s4\">
          <label>IEEE754</label>
          <br/>
          <input type=\"checkbox\" class=\"w3-check\" name=\"ieee754\" value=\"0\" checked=\"checked\">
          </div>";
    echo "<div class=\"w3-col m4 s4\">
          <label>Low Word First</label>
          <br/>
          <input type=\"checkbox\" class=\"w3-check\" name=\"low_first\" value=\"0\" checked=\"checked\">
          </div>
          </div>
          <br/>";
    echo "<div class=\"w3-row-padding\">
            <div class=\"w3-col m12 s12\">
                <div class=\"w3-right\">
                    <input type=\"submit\" class=\"w3-button w3-gray w3-text-white w3-card-4\" value=\"Save\" />
                </div>
            </div>
        </div>
          </form>
          <br/>
          </div>";
    echo "</div>
          </div>";
}


function register_type($item)
{
    $conn    = Connect();
    echo "<select name='reg_type'>";
    $reg_types_sql = "SELECT id, reg_types FROM mbus_reg_types";
    $reg_types_result = $conn->query($reg_types_sql);
    if ($reg_types_result->num_rows > 0) {
        $reg_types_row = $reg_types_result->fetch_array($item);
    } else {
        echo "0 results";
    }
    echo "</select>";
    $conn->close();
    return $reg_types_row["reg_types"];
}
?>
