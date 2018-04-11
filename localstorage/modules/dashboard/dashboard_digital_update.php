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
                    <div class=\"w3-col m12 s12\">\n";
          echo "<div class=\"label\">";
          if ($row['state']) {
              echo "<span class=\"dot\"><span class=\"greendot\"></span></span>";
          } else {
              echo "<span class=\"dot\"><span class=\"reddot\"></span></span>";
          }
            echo $row["name"];
        echo "</div>";



          echo "</div>
                </div>\n";
                echo "<br/>";
      }
  }
?>
