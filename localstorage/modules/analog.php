<?php
require_once "connection.php";
echo "<div class='w3-panel w3-border'>\n<h4>Analog Inputs</h4>\n";
$conn    = Connect();
$sql = "SELECT ai_status.id, ai_status.state, ai_configs.name, ai_configs.unit, ai_configs.min, ai_configs.max
    FROM ai_status
    INNER JOIN ai_configs
    ON ai_status.id=ai_configs.id";
$result = $conn->query($sql);
$conn->close();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class=\"w3-card-4\">";
        echo "<header class=\"w3-container w3-light-gray w3-border-bottom\">
                <div class=\"w3-left\">".$row['name']."</div>
                <div class=\"w3-right\"><span id=\"a_".$row['id']."\">aaa</span>".$row['unit']."</div>
            </header>\n";
        echo "<div class=\"w3-light-gray\">
                    <div class=\"w3-grey\" style=\"height:15px;width:";
        $val = $row['state']*100/($row['max']-$row['min']);
        echo $val;
        echo "%\">&nbsp;</div>
                  </div></div>
                  <br/>";
    }
} else {
    echo "No results";
}
echo "</div>\n";


echo "<script type='text/javascript'>
        function showUpdate()
        {
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function()
            {
                if (this.readyState == 4 && this.status == 200)
                {
                    document.getElementById(\"a_1\").innerHTML = this.responseText;
                }
            };
            xhttp.open(\"GET\", \"get_values.php?q=\"+str, true);
            xhttp.send();
        }
        </script>";



 ?>
