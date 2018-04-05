<?php
    require_once "../connection.php";
    $conn    = Connect();
    $sql = "SELECT ai_status.id, ai_status.state, ai_configs.enabled, ai_configs.name, ai_configs.unit, ai_configs.min, ai_configs.max
            FROM ai_status
            INNER JOIN ai_configs
            ON ai_status.id=ai_configs.id";
    $result = $conn->query($sql);
    $conn->close();

    if ($result->num_rows > 0) {
        echo "<style>
        #meter_item
        {
            width: 100%;
        }

        #scale {
            display: table;
            width: 100%;
            padding: 0px 0px 0px 0px;
            margin: 2px 0px 10px 0px;
            border: 0px 0px 0px 0px;
            text-align: center;
        }

        #scale li {
            width: 10%;
            display: table-cell;
            white-space: nowrap;
        }​
        </style>";
        while ($row = $result->fetch_assoc()) {
          if ($row['enabled']){
            echo  "<div class=\"w3-border\">
                        <header class=\"w3-container\">
                            <div class=\"w3-left\">".$row['name']."</div>
                            <div class=\"w3-right\">".round($row['state'],2)." ".$row['unit']."</div>
                        </header>
                        <div class=\"w3-container\">";
                  echo "<meter id=\"meter_item\" min=\"".$row['min']."\" value=\"".$row['state']."\" max=\"".$row['max']."\"></meter>";
                 $scale = $row['max']-$row['min'];
                  echo "<ul id=\"scale\">
                            <li style=\"width: 5%\"><span></span></li>
                            <li><span id=\"scale\">".($row['min']+$scale*1/10)."</span></li>
                            <li><span id=\"scale\">".($row['min']+$scale*2/10)."</span></li>
                            <li><span id=\"scale\">".($row['min']+$scale*3/10)."</span></li>
                            <li><span id=\"scale\">".($row['min']+$scale*4/10)."</span></li>
                            <li><span id=\"scale\">".($row['min']+$scale*5/10)."</span></li>
                            <li><span id=\"scale\">".($row['min']+$scale*6/10)."</span></li>
                            <li><span id=\"scale\">".($row['min']+$scale*7/10)."</span></li>
                            <li><span id=\"scale\">".($row['min']+$scale*8/10)."</span></li>
                            <li><span id=\"scale\">".($row['min']+$scale*9/10)."</span></li>
                            <li style=\"width: 5%\"><span id=\"scale\"></span></li>
                        </ul>\n";
                echo "</div>
                    </div>
                    <br/>\n";
                  }

        }
    }

?>
