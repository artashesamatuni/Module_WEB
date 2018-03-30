<?php
  require_once "../connection.php";
  require_once "../soc.php";
  $conn    = Connect();
  $sql = "SELECT rl_status.id, rl_status.state, rl_configs.name
  FROM rl_status
  INNER JOIN rl_configs
  ON rl_status.id=rl_configs.id";
  $result = $conn->query($sql);
  $conn->close();
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $msg = "get_rl_".$row['id'];
          $val = get($msg);
          echo "<div class=\"w3-row-padding\">
                    <div class=\"w3-col m2 s2\">\n";
                    echo "<input class=\"w3-radio\" type=\"radio\"";
                    if ($row['state']) {
                        echo " checked/>";
                    } else {
                        echo "/>";
                    }
          echo "</div>";
          echo "<div class=\"w3-col m10 s10\">\n";
          echo "<button type=\"submit\" name=\"do".$row["id"]."\" class=\"w3-button w3-block w3-white w3-border w3-round-large ";
          if ($val) {
              echo "w3-border-green";
          } else {
              echo "w3-border-red";
          }
          echo "\">".$row["name"];
          if ($val) {
              echo " ON";
          } else {
              echo " OFF";
          }
          echo "</button>\n";
            echo "</div>
            </div>\n";
          echo "<br/>";
      }
}
?>
