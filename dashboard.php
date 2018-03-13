<?php
require "connection.php";

function relay_panel()
{
echo "
<div class='w3-panel w3-border'>
  <h4>Relay Outputs</h4>
  <br/>
  <table style='width:100%'>
          <tbody>";
          //-------------------------------
          $conn    = Connect();
          $rl_status_sql = "SELECT id, state FROM rl_status";
          $rl_status_result = $conn->query($rl_status_sql);

          if ($rl_status_result->num_rows > 0)
          {
              while($rl_status_row = $rl_status_result->fetch_assoc()) {
                  echo "<tr>
                          <td style='width: 10%'>".$rl_status_row['id']."</td>
                          <td style='width: 20%'>".$rl_status_row['state']."</td>
                          <td style='width: 80%'><button style='width:100%'></button></td>
                        </tr>";
              }
          }
          else
          {
              echo "No results";
          }
          $conn->close();
          //-------------------------------
  echo "</tbody>
    </table>
    <br/>
</div>";
}


function analog_panel()
{
  echo "<div class='w3-panel w3-border'>
      <h4>Analog Inputs</h4>
      <table style='width:100%'>
              <tbody>";
              //-------------------------------
              $conn    = Connect();
              $ai_status_sql = "SELECT id,state FROM ai_status";
              $ai_status_result = $conn->query($ai_status_sql);

              if ($ai_status_result->num_rows > 0)
              {
                  while($ai_status_row = $ai_status_result->fetch_assoc()) {
                      echo "<tr>
                      <td style='width: 10%'>".$ai_status_row['id']."</td>
                              <td style='width: 40%'>".$ai_status_row['state']."</td>
                              <td style='width: 50%'><progress style='width: 100%;height: 18px' max='100' value='".$ai_status_row['state']."'></progress></td>
                            </tr>";
                  }
              }
              else
              {
                  echo "No results";
              }
              $conn->close();
              //-------------------------------
      echo "</tbody>
        </table>
      <br/>
  </div>";
}

function digital_panel()
{
  echo "<div class='w3-panel w3-border'>
      <h4>Digital Inputs</h4>
      <table style='width: 100%'>

      </table>
      <br/>
  </div>";
}

?>
