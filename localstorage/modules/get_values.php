<?php
require_once "connection.php";
$conn    = Connect();
$sql = "SELECT ai_status.state, ai_configs.name, ai_configs.unit, ai_configs.min, ai_configs.max
    FROM ai_status
    INNER JOIN ai_configs
    ON ai_status.id=ai_configs.id";
$result = $conn->query($sql);
$conn->close();
$a=array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($a,$row['state']);
        /*
        echo "<div class=\"w3-card-4\">";
        echo "<header class=\"w3-container w3-light-gray w3-border-bottom\">
                <div class=\"w3-left\">".$row['name']."</div>
                <div class=\"w3-right\">".$row['state']." ".$row['unit']."</div>
            </header>\n";
        echo "<div class=\"w3-light-gray\">
                    <div class=\"w3-grey\" style=\"height:15px;width:";
        $val = $row['state']*100/($row['max']-$row['min']);
        echo $val;
        echo "%\">&nbsp;</div>
                  </div></div>
                  <br/>";
                  */
    }
    print_r($a);
}
?>
