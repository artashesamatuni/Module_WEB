<?php
  require_once "../connection.php";
  require_once "../soc.php";
  $conn    = Connect();
  $sql = "SELECT rl_status.id, rl_status.state, rl_configs.name, rl_configs.mode
  FROM rl_status
  INNER JOIN rl_configs
  ON rl_status.id=rl_configs.id";
  $result = $conn->query($sql);
  $conn->close();
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {

          if ($row["mode"]==1) {
              echo "<div class=\"w3-row-padding\">
                        <div class=\"w3-col m12 s12\">\n";
              echo "<button type=\"submit\" name=\"do".$row["id"]."\" class=\"but\">";
                if ($row['state']) {
                echo "<span class=\"dot\"><span class=\"greendot\">";
                } else {
                echo "<span class=\"dot\"><span class=\"reddot\">";
                }
                echo "</span></span><b>[Button]</b> ".$row["name"]." ";
                if ($row['state']) {
                    echo " ON";
                } else {
                    echo " OFF";
                }
                echo "</button>";
                echo "</div>
                  </div>\n";
          }
          if ($row["mode"]==2) {
              echo "<div class=\"w3-row-padding\">
                        <div class=\"w3-col m12 s12\">\n";
              echo "<div class=\"label\">";
                if ($row['state']) {
                echo "<span class=\"dot\"><span class=\"greendot\">";
                } else {
                echo "<span class=\"dot\"><span class=\"reddot\">";
                }
                echo "</span></span><b>[Node]</b> ".$row["name"]." ";
                if ($row['state']) {
                    echo " ON";
                } else {
                    echo " OFF";
                }
                echo "</div>";
                echo "</div>
                  </div>\n";
          }
          if ($row["mode"]==3) {
              echo "<div class=\"w3-row-padding\">
                        <div class=\"w3-col m12 s12\">\n";
              echo "<div class=\"label\">";
                if ($row['state']) {
                echo "<span class=\"dot\"><span class=\"greendot\">";
                } else {
                echo "<span class=\"dot\"><span class=\"reddot\">";
                }
                echo "</span></span><b>[Timer]</b> ".$row["name"]." ";
                if ($row['state']) {
                    echo " ON";
                } else {
                    echo " OFF";
                }
                echo "</div>";
                echo "</div>
                  </div>\n";
          }
          echo "<br/>";
      }
}
?>
