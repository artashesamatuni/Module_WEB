<?php
require 'basic.php';
require 'menu.php';
require 'connection.php';
require 'tabs.php';
head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>\n";

$cur = 'Digital Outputs';
show_menu($cur);

echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";

$t_names = array("Relay 0", "Relay 1","Relay 2","Relay 3");

draw_tabs($t_names,0);


echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">\n";
            ro_config(0);
echo "</div>
    </div>";
footer(); echo "</div>
</body>\n";

//echo "<script src=\"lib.js\" type=\"text/javascript\"></script>
//      <script src=\"config.js\" type=\"text/javascript\"></script>\n";
echo "</html>";

function ro_config($cur)
{
        $conn    = Connect();
        $sql = "SELECT id, name, enabled, polarity FROM rl_configs";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          if (($row["id"])==$cur) {
                echo "<div id=\"tab".($row["id"])."\" class=\"w3-show\">\n";
              }
              else {
                echo "<div id=\"tab".($row["id"])."\" class=\"w3-hide\">\n";
              }
echo "<br/>
<form method=\"post\">\n";
echo "<input name=\"enabled\" type=\"hidden\" value=\"0\">";
if ($row["enabled"]===1) {
  echo "<input type=\"checkbox\" name=\"enabled\" value=\"".$row["enabled"]."\" checked/>&nbsp;Enabled\n";
}
else {
  echo "<input type=\"checkbox\" name=\"enabled\" value=\"".$row["enabled"]."\" />&nbsp;Disabled\n";
}
                        echo "<br/>Label<br/>
                              <input name=\"name\" type=\"text\" placeholder=\"e.g. Room temperature\" value=\"".$row["name"]."\" />
                              <br/>
                              <br/>";
                              echo "<input name=\"polarity\" type=\"hidden\" value=\"0\">
                              <input name=\"polarity\" type=\"checkbox\" value=\"";
                        if ($row["polarity"]) {
                              echo $row["polarity"]."\" checked/>
                              Invercse\n";
                            }
                            else {
                              echo $row["polarity"]."\" />
                              Normal\n";
                            }
                        echo "<br/>
                              <br/>
                              <input type=\"submit\" name=\"insert".$row["id"]."\" value=\"Save\">
                              </form>
                              <br/>
                            </div>\n";
                          }
        }
    $conn->close();
}

if(isset($_POST['insert0'])){
  save(0);
}
if(isset($_POST['insert1'])){
  save(1);
}
if(isset($_POST['insert2'])){
  save(2);
}
if(isset($_POST['insert3'])){
  save(3);
}




function save($id)
    {
      $conn    = Connect();
      $name       = $conn->real_escape_string($_POST['name']);
      $polarity   = $conn->real_escape_string($_POST['polarity']);
      $enabled    = $conn->real_escape_string($_POST['enabled']);

      $sql = "UPDATE rl_configs SET name = '".$name."', polarity=".$polarity.", enabled=".$enabled." WHERE id = ".$id."";
      $result = $conn->query($sql);
      echo $sql;

      if (!$result) {
          die("Couldn't enter data: ".$conn->error);
      }

      $conn->close();


    }
?>
