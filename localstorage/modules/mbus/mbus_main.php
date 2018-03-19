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
new_node_modal();




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
