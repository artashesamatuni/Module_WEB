<?php
  require_once "../connection.php";
  require_once "../soc.php";
  $conn = Connect();
  $sql = "SELECT di_configs.id, di_status.state, di_configs.name
  FROM di_status
  INNER JOIN di_configs
  ON di_status.id=di_configs.id";
  $result = $conn->query($sql);
  $conn->close();
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
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
          echo "<div name=\"di".$row["id"]."\" class=\"w3-panel w3-round-large w3-border\"><p>".$row["name"];
          if ($row['state']) {
              echo " ON";
          } else {
              echo " OFF";
          }
          echo "</p></div>\n";
          echo "</div>
          </div>
                \n";
      }
  }
?>
