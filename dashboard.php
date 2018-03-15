<?php
require "connection.php";

function relay_panel()
{
    echo "
<div class='w3-panel w3-border'>
  <h4>Relay Outputs</h4>
  <br/>
  <table class=\"w3-table\" style='width:100%'>";
    //-------------------------------
    $conn    = Connect();
    $rl_status_sql = "SELECT rl_status.state, rl_configs.name
    FROM rl_status
    INNER JOIN rl_configs
    ON rl_status.id=rl_configs.id";
    $rl_status_result = $conn->query($rl_status_sql);
    if ($rl_status_result->num_rows > 0) {
        echo "<tbody>";
        while ($rl_status_row = $rl_status_result->fetch_assoc()) {
            echo "<tr>
                          <td style='width: 10%'>";
            if ($rl_status_row['state']) {
                echo "<img src=\"images\led_on.png\" alt=\"ON\" width=\"32\" height=\"32\">";
            } else {
                echo "<img src=\"images\led_off.png\" alt=\"ON\" width=\"32\" height=\"32\">";
            }
            echo "</td>
                  <td style='width: 90%'><button class=\"w3-button w3-block w3-blue\">".$rl_status_row['name']."</button></td>
                  </tr>";
        }
        echo "</tbody>";
    } else {
        echo "No results";
    }
    $conn->close();
    //-------------------------------
    echo "
    </table>
    <br/>
</div>";
}


function analog_panel()
{
    echo "<div class='w3-panel w3-border'>
      <h4>Analog Inputs</h4>
      <br/>";

    echo "<table class=\"w3-table\" style='width:100%'>";
    //-------------------------------
    $conn    = Connect();
    $ai_status_sql = "SELECT ai_status.state, ai_configs.name, ai_configs.unit, ai_configs.min, ai_configs.max
        FROM ai_status
        INNER JOIN ai_configs
        ON ai_status.id=ai_configs.id";
    $ai_status_result = $conn->query($ai_status_sql);
    if ($ai_status_result->num_rows > 0) {
        echo "<tbody>";
        while ($ai_status_row = $ai_status_result->fetch_assoc()) {
            echo "<tr>
                    <td style=\"width: 50%\">".$ai_status_row['name']." ".$ai_status_row['state']." ".$ai_status_row['unit']."</td>";
            echo "<td style=\"width: 50%\">
                      <div class=\"w3-border\">
                        <div class=\"w3-grey\" style=\"height:24px;width:";
            $val = $ai_status_row['state']*100/($ai_status_row['max']-$ai_status_row['min']);
            echo $val;
            echo "%\">&nbsp;</div>
                      </div>
                  </td>
                      </tr>";
        }
        echo "</tbody>";
    } else {
        echo "No results";
    }
    $conn->close();
    //-------------------------------
    echo "
        </table>";

    echo "<br/>
  </div>";
}

function digital_panel()
{
    echo "
<div class='w3-panel w3-border'>
  <h4>Relay Outputs</h4>
  <br/>
  <table class=\"w3-table\" style='width:100%'>";
    //-------------------------------
    $conn    = Connect();
    $di_status_sql = "SELECT di_status.state, di_configs.name
    FROM di_status
    INNER JOIN di_configs
    ON di_status.id=di_configs.id";
    $di_status_result = $conn->query($di_status_sql);
    if ($di_status_result->num_rows > 0) {
        echo "<tbody>";
        while ($di_status_row = $di_status_result->fetch_assoc()) {
            echo "<tr>
                          <td style='width: 10%'>";
            if ($di_status_row['state']) {
                echo "<img src=\"images\led_on.png\" alt=\"ON\" width=\"32\" height=\"32\">";
            } else {
                echo "<img src=\"images\led_off.png\" alt=\"ON\" width=\"32\" height=\"32\">";
            }
            echo "</td>
                  <td style='width: 90%'>".$di_status_row['name']."</td>
                  </tr>";
        }
        echo "</tbody>";
    } else {
        echo "No results";
    }
    $conn->close();
    //-------------------------------
    echo "
    </table>
    <br/>
</div>";
}
