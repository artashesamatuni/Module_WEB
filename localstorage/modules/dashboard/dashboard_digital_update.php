<?php
  require_once "../connection.php";
  require_once "../soc.php";
  echo "<style>
        .label {
            display: inline-block;
            padding: 0 20px;
            height: 40px;
            width: 100%;
            font-size: 16px;
            line-height: 40px;
            border-radius: 20px;
            background-color: #f1f1f1;
        }

        .reddot {
            float: left;
            margin: 5px 15px 0 -15px;
            height: 30px;
            width: 30px;
            background-color: #f44336;
            line-height: 30px;
            border-radius: 50%;
            display: inline-block;
        }

        .greendot {
            float: left;
            margin: 5px 15px 0 -15px;
            height: 30px;
            width: 30px;
            background-color: #4CAF50;
            line-height: 30px;
            border-radius: 50%;
            display: inline-block;
        }
    </style>";
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

          /*
                    <div class=\"w3-col m2 s2\">\n";
                    if ($row['state']) {
                        echo "<span class=\"greendot\"></span>";
                    } else {
                        echo "<span class=\"reddot\"></span>";
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
          echo "</div>";
          */
          echo "<div class=\"label\">";
          if ($row['state']) {
              echo "<span class=\"greendot\"></span>";
          } else {
              echo "<span class=\"reddot\"></span>";
          }
            echo $row["name"];
        echo "</div>";



          echo "</div>
                </div>\n";
                echo "<br/>";
      }
  }
?>
