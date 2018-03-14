<?php
require 'basic.php';
require 'menu.php';
require 'connection.php';
require 'tabs.php';
head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>\n";

$cur = 'Digital Inputs';
show_menu($cur);

echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";

$t_names = array("Channel 0", "Channel 1","Channel 2","Channel 3");

draw_tabs($t_names,0);


echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">\n";
            ai_config(0);
echo "</div>
    </div>";
footer(); echo "</div>
</body>\n";
echo "<script src=\"lib.js\" type=\"text/javascript\"></script>
      <script src=\"config.js\" type=\"text/javascript\"></script>\n";
echo "</html>";


function ai_config($cur)
{
        $conn    = Connect();
        $sql = "SELECT id, name, enabled, unit, min, max FROM ai_configs";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          if (($row["id"]-1)===$cur) {
                echo "<div id=\"tab".($row["id"]-1)."\" class=\"w3-show\">";
              }
              else {
                echo "<div id=\"tab".($row["id"]-1)."\" class=\"w3-hide\">";
              }
                echo "<br/>";
                if ($row["enabled"]===1) {
                echo "<input type=\"checkbox\" value=\"".$row["enabled"]."\" checked/>";
              }
              else {
                echo "<input type=\"checkbox\" value=\"".$row["enabled"]."\" />";
              }
                        if ($row["enabled"]){
                            echo "Enabled\n";
                        }
                        else {
                            echo "Disabled\n";
                        }
                        echo "<br/>Label<br/>
                              <input type=\"text\" placeholder=\"e.g. Room temperature\" value=\"".$row["name"]."\" />
                              <br/>Unit<br/>
                              <input type=\"text\" placeholder=\"e.g. &deg;C\" value=\"".$row["unit"]."\" />
                              <br/>Scaling<br/>
                              <sub>min</sub><br/>
                              <input type=\"number\" placeholder=\"e.g. 0\" value=\"".$row["min"]."\" />
                              <br/><sub>max</sub><br/>
                              <input type=\"number\" placeholder=\"e.g. 250\" value=\"".$row["max"]."\" />
                              <br/>
                              <br/>
                            </div>\n";
                          }
        }
    $conn->close();
}
?>
