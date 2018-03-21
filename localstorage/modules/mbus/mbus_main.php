<?php
#mbus_main.php
require '../connection.php';
require '../basic.php';
require '../menu.php';
require '../tabs.php';

head();
start_line();
$cur = 'Modbus Settings';
show_menu($cur);
echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";
$t_names = array("Configuration", "Nods");
$cur_tab = $_COOKIE['c_tab'];
draw_tabs($t_names, $cur_tab);
read_config($cur_tab);
echo "</div>\n";
footer();
$id = 'help';
$label = "Test Help";
modal($id,$label);
end_line();
new_node_modal();
edit_node_modal();



function read_config($cur_tab)
{
    echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">\n";
    if ($cur_tab == 1) {
        echo "<div id=\"tab1\" class=\"w3-container w3-show\">\n";
    } else {
        echo "<div id=\"tab1\" class=\"w3-container w3-hide\">\n";
    }
    require_once 'mbus_config_load.php';
    echo "</div>\n";


    if ($cur_tab == 2) {
        echo "<div id=\"tab2\" class=\"w3-container w3-show\">\n";
    } else {
        echo "<div id=\"tab2\" class=\"w3-container w3-hide\">\n";
    }
    require_once 'mbus_nods_load.php';
    echo "</div>\n";

    echo "</div>\n";
}

function edit_node_modal()
{
    echo "<div id=\"edit\" class=\"w3-modal\">
                <div class=\"w3-modal-content\">
                <span onclick=\"document.getElementById('edit').style.display='none'\" class=\"w3-button w3-light-gray w3-text-red w3-display-topright\"><i class=\"fa fa-close\"></i></span>";
    echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">
            <h4>Edit Modbus node</h4>\n";
    echo  "<form method=\"post\" action=\"mbus_new_node.php\">\n";
    require_once '../connection.php';
    $conn = Connect();
    $sql = "SELECT id, name, dev_addr, reg_addr, reg_type,unit,slope,offset,bit32,ieee754,low_first FROM mbus_nods WHERE id=1;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class=\"w3-row-padding\">";
                echo "<div class=\"w3-col m4 s4\">
                          <label>Name</label>
                          <input type=\"text\" class=\"w3-input w3-border\" name=\"name\" value=\"".$row["name"]."\"/>
                      </div>";
                echo "<div class=\"w3-col m2 s4\">
                          <label>Dev.</label>
                          <input type=\"number\" class=\"w3-input w3-border\" name=\"dev_addr\" value=\"".$row["dev_addr"]."\"/>
                      </div>";
                echo "<div class=\"w3-col m2 s4\">
                          <label>Reg.</label>
                          <input type=\"number\" class=\"w3-input w3-border\" name=\"reg_addr\" value=\"".$row["reg_addr"]."\"/>
                      </div>";
                      echo "<div class=\"w3-col m2 s4\">\n";
                            register_type();
                      echo "</div>";
                      echo "<div class=\"w3-col m2 s4\">
                                <label>Unit</label>
                                <input type=\"text\" class=\"w3-input w3-border\" name=\"unit\" value=\"".$row["unit"]."\"/>
                            </div>";
                echo "<div class=\"w3-col m2 s2\">
                      <label>Slope</label>
                      <input type=\"number\" class=\"w3-input w3-border\" name=\"slope\" value=\"".$row["slope"]."\"/>
                      </div>";
                echo "<div class=\"w3-col m2 s2\">
                      <label>Offset</label>
                      <input type=\"number\" class=\"w3-input w3-border\" name=\"offset\" value=\"".$row["offset"]."\"/>
                      </div>";
                echo "<div class=\"w3-col m2 s0\">
                        &nbsp;
                      </div>
                      </div>";
                echo "<div class=\"w3-row-padding\">
                        <div class=\"w3-col m3 s5\">
                            <label>32 bit</label>
                            <br/>\n";
                            if($row["unit"]) {
                            echo "<input type=\"checkbox\" class=\"w3-check\" name=\"bit32\" value=\"1\" checked=\"checked\"/>\n";
                        }
                        else {
                            echo "<input type=\"checkbox\" class=\"w3-check\" name=\"bit32\" value=\"0\"/>\n";
                        }
                echo "</div>
                    </div>\n";
                    echo "<div class=\"w3-row-padding\">
                            <div class=\"w3-col m3 s5\">
                      <label>IEEE754</label>
                      <br/>\n";
                      if($row["ieee754"]) {
                      echo "<input type=\"checkbox\" class=\"w3-check\" name=\"ieee754\" value=\"1\" checked=\"checked\"/>\n";
                  }
                  else {
                      echo "<input type=\"checkbox\" class=\"w3-check\" name=\"ieee754\" value=\"0\"/>\n";
                  }
          echo "</div>
                  </div>\n";
                  echo "<div class=\"w3-row-padding\">
                          <div class=\"w3-col m3 s5\">
                      <label>Low Word First</label>
                      <br/>\n";
                      if($row["low_first"]) {
                      echo "<input type=\"checkbox\" class=\"w3-check\" name=\"low_first\" value=\"1\" checked=\"checked\"/>\n";
                  }
                  else {
                      echo "<input type=\"checkbox\" class=\"w3-check\" name=\"low_first\" value=\"0\"/>\n";
                  }
          echo "</div>
                  </div>\n";
                      echo "<br/>";
                echo "<div class=\"w3-row-padding\">
                        <div class=\"w3-col m12 s12\">
                            <input type=\"submit\" class=\"w3-button w3-block w3-green\" value=\"Save\" />
                        </div>
                    </div>";
        }
    }
        echo "</form>
              <br/>
            </div>
        </div>
    </div>";
    $conn->close();






}

function new_node_modal()
{
    echo "<script>
    var modal = document.getElementById('add');

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
    </script>";

    echo "<div id=\"add\" class=\"w3-modal\">
                <div class=\"w3-modal-content\">
                    <button class=\"w3-button w3-right w3-red w3-display-topright\" onclick=\"document.getElementById('add').style.display='none'\">&times;</button>";
    echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">\n
      <h4>Add new Modbus node</h4>
      <form method=\"post\" action=\"mbus_new_node.php\">
      <div class=\"w3-row-padding\">";
    echo "<div class=\"w3-col m4 s4\">
              <label>Name</label>
              <input type=\"text\" class=\"w3-input w3-border\" max=\"10\" name=\"name\" />
          </div>";
    echo "<div class=\"w3-col m2 s4\">
              <label>Dev. addr.</label>
              <input type=\"number\" class=\"w3-input w3-border\" name=\"dev_addr\" />
          </div>";
    echo "<div class=\"w3-col m2 s4\">
              <label>Reg. addr.</label>
              <input type=\"number\" class=\"w3-input w3-border\" name=\"reg_addr\" />
          </div>";
          echo "<div class=\"w3-col m2 s4\">\n";
                register_type();
          echo "</div>";
          echo "<div class=\"w3-col m2 s4\">
                    <label>Unit</label>
                    <input type=\"text\" class=\"w3-input w3-border\" name=\"unit\" />
                </div>";
    echo "<div class=\"w3-col m2 s2\">
          <label>Slope</label>
          <input type=\"number\" class=\"w3-input w3-border\" name=\"slope\" value=\"1\" />
          </div>";
    echo "<div class=\"w3-col m2 s2\">
          <label>Offset</label>
          <input type=\"number\" class=\"w3-input w3-border\" name=\"offset\" value=\"0\" />
          </div>";
    echo "<div class=\"w3-col m2 s0\">
            &nbsp;
          </div>";
    echo "<div class=\"w3-col m2 s4\">
          <label>32 bit</label>
          <br/>
          <input type=\"checkbox\" class=\"w3-check\" name=\"bit32\" value=\"0\" checked=\"checked\">
          </div>";
    echo "<div class=\"w3-col m2 s4\">
          <label>IEEE754</label>
          <br/>
          <input type=\"checkbox\" class=\"w3-check\" name=\"ieee754\" value=\"0\" checked=\"checked\">
          </div>";
    echo "<div class=\"w3-col m2 s4\">
          <label>Low Word First</label>
          <br/>
          <input type=\"checkbox\" class=\"w3-check\" name=\"low_first\" value=\"0\" checked=\"checked\">
          </div>
          </div>
          <br/>";
    echo "<div class=\"w3-row-padding\">
            <div class=\"w3-col m12 s12\">
                <div class=\"w3-right\">
                    <input type=\"submit\" class=\"w3-button w3-green\" value=\"Save\" />
                </div>
            </div>
        </div>
          </form>
          <br/>
          </div>";
    echo "</div>
          </div>";
}


function register_type()
{
    echo "<label>Reg. type</label>\n";
    echo "<select name=\"reg_type\" class=\"w3-select w3-border\">";
    $conn = Connect();
    $sql = "SELECT id, reg_types FROM mbus_reg_types";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value=\"".$row["id"]."\">".$row["reg_types"]."</option>";
        }
    } else {
        echo "No result";
    }
    $conn->close();
    echo "</select>\n";
}
?>
