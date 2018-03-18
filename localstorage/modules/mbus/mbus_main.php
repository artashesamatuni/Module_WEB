<?php
require '../connection.php';
require '../basic.php';
require '../menu.php';
require '../tabs.php';

head();
$cur = 'Modbus Settings';
show_menu($cur);
echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";
$t_names = array("Modbus-RTU", "Channels");
$cur_tab = $_COOKIE['c_tab'];
draw_tabs($t_names, $cur_tab);
read_config($cur_tab);
echo "</div>\n";
footer();
/*
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
*/
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------
function read_config($cur_tab)
{
    echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">\n";
    require_once 'mbus_config.php';
    echo "</div>\n";
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
