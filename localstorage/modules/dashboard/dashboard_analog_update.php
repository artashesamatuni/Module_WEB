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
        while ($row = $result->fetch_assoc()) {
          if ($row['enabled']){
            echo  "<div class=\"w3-card-4 w3-border\">
                        <header class=\"w3-container\">
                            <div class=\"w3-left\">".$row['name']."</div>
                            <div class=\"w3-right\">".$row['state']." ".$row['unit']."</div>
                        </header>
                        <divclass=\"w3-container\">
                          <div class=\"w3-light-gray\">
                              <div class=\"w3-blue\" style=\"height:15px;width:".$row['state']*100/($row['max']-$row['min'])."%\">&nbsp;</div>
                          </div>
                        </div>
                    </div>
                    <br/>\n";
                  }

        }
    }
?>
