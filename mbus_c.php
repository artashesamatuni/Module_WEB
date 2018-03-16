<?php
require 'modules/connection.php';
require 'modules/basic.php';
require 'modules/menu.php';
require 'modules/tabs.php';


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
            show_nodes();
            echo "<button onclick=\"document.getElementById('add').style.display='block'\" class=\"w3-btn w3-blue w3-card-4\">Add</button>
            <br/>
        </div>
        <br/>
    </div>
</div>\n</div>";
?>
        <!-------------------------------------------------------------------------------------------------------->
        <div id="add" class="w3-modal">
            <div class="w3-modal-content">
                <button class="w3-right" onclick="document.getElementById('add').style.display='none'" class="w3-display-topright">&times;</button>
                <?php new_node(); ?>
            </div>
        </div>
        <?php footer();
echo "</body>\n";
echo "<script src=\"lib.js\" type=\"text/javascript\"></script>
      <script src=\"config.js\" type=\"text/javascript\"></script>\n";
echo "</html>";
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
function mbus_config()
{
    $conn    = Connect();
    echo "<br/>
          <form method=\"post\" action=\"save_mbus.php\">";
    $mbus_sql = "SELECT enabled, baud_rate, parity, stop_bits,data_bits,read_interval,read_timeout FROM mbus_configs";
    $mbus_result = $conn->query($mbus_sql);
    if ($mbus_result->num_rows > 0) {
        while ($mbus_row = $mbus_result->fetch_assoc()) {
            echo "<div class=\"w3-row-padding\">
                    <div class=\"w3-col m3 s4\">";
            if ($row["enabled"]==1) {
                echo "<label>Enabled</label><input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"1\" checked=\"checked\"/>\n";
            } else {
                echo "<label>Disabled</label><input type=\"checkbox\" class=\"w3-check\" name=\"enabled\" value=\"0\" />\n";
            }
            echo "</div>
                    <div class=\"w3-col m3 s4\">
                      <label>Read Interval[sec.]</label>
                      <input name=\"read_interval\" class=\"w3-input w3-border\" type=\"number\" min=\"1\" max=\"300\" value=\"".$mbus_row["read_interval"]."\" />
                    </div>
                    <div class=\"w3-col m3 s6\">
                      <label>Read Timeout[sec.]</label>
                      <input name=\"read_timeout\" class=\"w3-input w3-border\" type=\"number\" min=\"1\" max=\"5\" value=\"".$mbus_row["read_timeout"]."\" />
                    </div>
                  </div>";
            echo "<div class=\"w3-row-padding\">
                    <div class=\"w3-col m3 s4\">";
            echo "<br/>Baud Rate<br/>
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
                </div>\n";
            //-------------------------------------------------------------------------------------------------------------------------------------
            echo "<div class=\"w3-col m3 s6\">
                    <br/>Parity<br/>
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
            //-------------------------------------------------------------------------------------------------------------------------------------
            echo "<div class=\"w3-col m3 s6\">
                    <br/>Stop Bits<br/>
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
            //-------------------------------------------------------------------------------------------------------------------------------------
            echo "<div class=\"w3-col m3 s6\">
                    <br/>Data Bits<br/>
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
                </div>
              </div>\n";
            //-------------------------------------------------------------------------------------------------------------------------------------

            echo "<br/>
                      <br/>
                <input type=\"submit\" value=\"Submit\" class=\"w3-btn w3-blue\"/>
              </form>
              <br/>\n";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
}

function show_nodes()
{
    $conn    = Connect();
    echo "<br/>
      <table class=\"w3-table w3-border\">
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
        </tr>\n";

    $sql = "SELECT id, name, dev_addr, reg_addr,reg_type,unit,slope,offset,bit32,ieee754,low_first FROM mbus_nods";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<tbody>\n";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["name"]."</td>
                    <td>".$row["dev_addr"]."</td>
                    <td>".$row["reg_addr"]."</td>";
            //-------------------------------------------
            $sql = "SELECT reg_types FROM mbus_reg_types WHERE id=2";//".$row["reg_type"]."\"";
            $reg_types_result = $conn->query($sql);
            $row1 = $reg_types_result->fetch_assoc();

            echo "<td>".$row1["reg_types"]."</td>";
            //---------------------------------------------
            echo "<td>".$row["unit"]."</td>
                    <td>".$row["slope"]."</td>
                    <td>".$row["offset"]."</td>\n";

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
            echo "</tr>\n";
        }
        echo "</tbody>\n";
    } else {
        echo "No data";
    }
    echo "</table>
      <br/>\n";

    $conn->close();
}

function new_node()
{
    echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">\n
      <h4>Add new Modbus unit</h4>\n
      <form method=\"post\" action=\"new_node.php\">\n
          Name<br/>\n<input type=\"text\" max=\"10\" name=\"name\" />\n
          <br/>Device addr.<br/>\n<input type=\"number\" name=\"dev_addr\" />\n
          <br/>Register addr.<br/>\n<input type=\"number\" name=\"reg_addr\" />\n
          <br/>Register type<br/>\n";
    $conn    = Connect();
    $reg_types_sql = "SELECT id, reg_types FROM mbus_reg_types";
    $reg_types_result = $conn->query($reg_types_sql);

    if ($reg_types_result->num_rows > 0) {
        echo "<select name=\"reg_type\">";
        while ($reg_types_row = $reg_types_result->fetch_assoc()) {
            echo "<option value=\"".$reg_types_row["id"]."\">".$reg_types_row["reg_types"]."</option>";
        }
        echo "</select>\n";
    } else {
        echo "No result";
    }
    $conn->close();
    echo "<br/>Unit<br/>\n<input type=\"text\" name=\"unit\" />\n
        <br/>Slope<br/>\n<input type=\"number\" name=\"slope\" value=\"1\" />\n
        <br/>Offset<br/>\n<input type=\"number\" name=\"offset\" value=\"0\" />\n
        <br/>\n<input type=\"hidden\" name=\"bit32\" value=\"0\" />\n<input type=\"checkbox\" name=\"bit32\" value=\"1\" />&nbsp;32 bit Enable\n
        <br/>\n<input type=\"hidden\" name=\"ieee754\" value=\"0\" />\n<input type=\"checkbox\" name=\"ieee754\" value=\"1\" />&nbsp;IEEE754\n
        <br/>\n<input type=\"hidden\" name=\"low_first\" value=\"0\" />\n<input type=\"checkbox\" name=\"low_first\" value=\"1\" />&nbsp;Low Word First\n
        <br/>\n<br/>\n<input type=\"submit\" value=\"Submit\" />\n<br/>\n<br/>\n</form>\n</div>\n";
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
