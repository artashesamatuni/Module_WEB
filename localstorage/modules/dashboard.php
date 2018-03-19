<?php
require "connection.php";

function get_ip()
{
    $ch = curl_init ();
    curl_setopt ($ch, CURLOPT_URL, "http://ipecho.net/plain");
    curl_setopt ($ch, CURLOPT_HEADER, 0);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

    $pubip = curl_exec ($ch);
    curl_close ($ch);

    return $pubip;
}



function relay_panel()
{
    echo "<form action=\"http://".get_ip().":81/do\" method=\"post\">
<div class='w3-panel w3-border'>
  <h4>Relay Outputs</h4>\n";
    $conn    = Connect();
    $rl_status_sql = "SELECT rl_status.id, rl_status.state, rl_configs.name
    FROM rl_status
    INNER JOIN rl_configs
    ON rl_status.id=rl_configs.id";
    $rl_status_result = $conn->query($rl_status_sql);
    if ($rl_status_result->num_rows > 0) {
        while ($rl_status_row = $rl_status_result->fetch_assoc()) {
            echo "<input type=\"submit\" name=\"do".$rl_status_row["id"]."\" class=\"w3-button w3-block ";
            if ($rl_status_row['state']) {
                echo "w3-green";
            } else {
                echo "w3-red";
            }
            echo "\" value=\"".$rl_status_row['name']." ";
            if ($rl_status_row['state']) {
                echo "ON";
            } else {
                echo "OFF";
            }
            echo "\" />\n";
            echo "<br/>";
        }
    } else {
        echo "No results";
    }
    $conn->close();
    echo "</div>
    </form>\n";
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
    echo "<div class='w3-panel w3-border'>
            <h4>Modbus Nods</h4>
            <table class=\"w3-table w3-border 3w-card-4\">
        <tr class=\"w3-light-gray\">
          <th>Name</th>
          <th>Value</th>
        </tr>\n";
    $sql = "SELECT mbus_nods.name, mbus_nods.unit, mbus_nods_values.value
    FROM mbus_nods
    INNER JOIN mbus_nods_values
    ON mbus_nods.id=mbus_nods_values.id";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<tbody>\n";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["name"]."</td>
                    <td>".$row["value"]." ".$row["unit"]."</td>
                 </tr>\n";
        }
        echo "</tbody>\n";
    } else {
        echo "No data";
    }
    echo "</table>
      <br/>
    </div>\n";
    $conn->close();
}
