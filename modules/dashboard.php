<?php
require "connection.php";

function relay_panel()
{
    echo "
<div class='w3-panel w3-border'>
  <h4>Relay Outputs</h4>\n";
    //-------------------------------
    $conn    = Connect();
    $rl_status_sql = "SELECT rl_status.state, rl_configs.name
    FROM rl_status
    INNER JOIN rl_configs
    ON rl_status.id=rl_configs.id";
    $rl_status_result = $conn->query($rl_status_sql);
    if ($rl_status_result->num_rows > 0) {
        while ($rl_status_row = $rl_status_result->fetch_assoc()) {
            echo "<button class=\"w3-button w3-block";
            if ($rl_status_row['state']) {
                echo " w3-light-gray ";
            } else {
                echo " w3-gray ";
            }
            echo "w3-card-4\">".$rl_status_row['name']." ";
            if ($rl_status_row['state']) {
                echo "ON";
            } else {
                echo "OFF";
            }
            echo "</button>
                  <br/>\n";
        }
    } else {
        echo "No results";
    }
    $conn->close();
    echo "</div>\n";
}


function analog_panel()
{
    echo "<div class='w3-panel w3-border'>\n<h4>Analog Inputs</h4>\n";
    $conn    = Connect();
    $ai_status_sql = "SELECT ai_status.state, ai_configs.name, ai_configs.unit, ai_configs.min, ai_configs.max
        FROM ai_status
        INNER JOIN ai_configs
        ON ai_status.id=ai_configs.id";
    $ai_status_result = $conn->query($ai_status_sql);
    if ($ai_status_result->num_rows > 0) {
        while ($ai_status_row = $ai_status_result->fetch_assoc()) {
            echo "<div class=\"w3-card-4\">";
            echo "<header class=\"w3-container w3-light-gray w3-border-bottom\">
                    <div class=\"w3-left\">".$ai_status_row['name']."</div>
                    <div class=\"w3-right\">".$ai_status_row['state']." ".$ai_status_row['unit']."</div>
                </header>\n";
            echo "<div class=\"w3-light-gray\">
                        <div class=\"w3-grey\" style=\"height:15px;width:";
            $val = $ai_status_row['state']*100/($ai_status_row['max']-$ai_status_row['min']);
            echo $val;
            echo "%\">&nbsp;</div>
                      </div></div>
                      <br/>";
        }
    } else {
        echo "No results";
    }
    $conn->close();
    //-------------------------------
    echo "</div>\n";
}

function digital_panel()
{
    echo "<div class='w3-panel w3-border'>\n<h4>Digital Input</h4>";
    $conn = Connect();
    $di_status_sql = "SELECT di_status.state, di_configs.name
    FROM di_status
    INNER JOIN di_configs
    ON di_status.id=di_configs.id";
    $di_status_result = $conn->query($di_status_sql);
    if ($di_status_result->num_rows > 0) {
        while ($di_status_row = $di_status_result->fetch_assoc()) {
            echo "<div class=\"w3-card-4 w3-center w3-padding";
            if ($di_status_row['state']) {
                echo " w3-light-gray\">";
            } else {
                echo " w3-gray\">";
            }
            echo $di_status_row['name']." ";
            if ($di_status_row['state']) {
                echo "ON";
            } else {
                echo "OFF";
            }
            echo "</div>\n<br/>\n";
        }
    } else {
        echo "No results";
    }
    $conn->close();
    echo "</div>\n";
}
function node_panel()
{
    $conn    = Connect();
    echo "<br/>
      <table class=\"w3-table w3-border\">
        <tr class=\"w3-light-gray\">
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


function add_zero($val, $cnt)
{
    $zero="";
    for ($i =1; $i < $cnt; $i++) {
        if ($val<10*i) {
            if ($cnt==i) {
                return $val;
            } else {
                for ($j =1; $j < $i; $j++) {
                    $zero+="0";
                }
                $zero+=$val;
                return $zero;
            }
        }
    }
}
