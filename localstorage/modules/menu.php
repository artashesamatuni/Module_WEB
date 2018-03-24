<?php
include 'settings.php';


function gen_user($user)
{
  echo "<a href=\"#\" class=\"w3-bar-item w3-button\">";
  switch ($user)
  {
      case 'admin':
          echo "<img src=\"/localstorage/images/img_avatar1.png\" class=\"w3-circle w3-border\" alt=\"Admin\" width=\"18\" height=\"18\"/>";
          break;
      case 'user':
          echo "<img src=\"/localstorage/images/img_avatar2.png\" class=\"w3-circle w3-border\" alt=\"Admin\" width=\"18\" height=\"18\"/>";
          break;
      case 'guest':
          echo "<img src=\"/localstorage/images/img_avatar3.png\" class=\"w3-circle w3-border\" alt=\"Admin\" width=\"18\" height=\"18\"/>";
          break;
  }
  echo "</a>";
}


function gen_dropdown($cur)
{
    if ($cur!='Analog Inputs') {
        echo "<a href=\"/localstorage/ai.php\" class=\"w3-bar-item w3-button w3-padding-large\">Analog Inputs</a>\n";
    }
    if ($cur!='Digital Inputs') {
        echo "<a href=\"/localstorage/di.php\" class=\"w3-bar-item w3-button w3-padding-large\">Digital Inputs</a>\n";
    }
    if ($cur!='Digital Outputs') {
        echo "<a href=\"/localstorage/do.php\" class=\"w3-bar-item w3-button w3-padding-large\">Digital Outputs</a>\n";
    }
    if ($cur!='MQTT Settings') {
        echo "<a href=\"/localstorage/modules/mqtt/mqtt_main.php\" class=\"w3-bar-item w3-button w3-padding-large\">MQTT Settings</a>\n";
    }
    if ($cur!='Modbus Settings') {
        echo "<a href=\"/localstorage/mbus.php\" class=\"w3-bar-item w3-button w3-padding-large\">Modbus Settings</a>\n";
    }
    if ($cur!='Access control') {
        echo "<a href=\"/localstorage/modules/access/login_main.php\" class=\"w3-bar-item w3-button w3-padding-large\">Access control</a>\n";
    }
    if ($cur!='Settings') {
        echo "<a href=\"/localstorage/config.php\" class=\"w3-bar-item w3-button w3-padding-large\">Settings</a>\n";
    }
}


function show_menu($cur)
{
    global $max_window;
    global $min_window;
    $user = 2;

    # Navbar
    echo "<!-------------------------------------------------------------------------------------------------------------------------------------------------->
          <div class=\"w3-top w3-light-gray w3-bar\" style=\"max-width:".$max_window."px;min-width:".$min_window."px\">\n";
      # Big
      echo "<div class=\"w3-bar w3-card-4 w3-left-align\">\n";
      echo "<a href=\"http://www.eaglemon.com\" target=\"_blank\" class=\"w3-bar-item w3-button\"><image alt=\"logo\" src=\"/localstorage/images/logo_s.png\" height=\"18\"/></a>\n";
      gen_user('admin');
      echo "<a class=\"w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right\" href=\"javascript:void(0);\" onclick=\"small_drop()\"><i class=\"fa fa-bars\"></i></a>\n";
      echo "<a class=\"w3-bar-item w3-button w3-hide-small w3-right\" href=\"javascript:void(0);\" onclick=\"big_drop()\">Configuration<i class=\"fa fa-bars\"></i></a>\n";
      if ($cur!='Dashboard') {
      echo "<a href=\"/index.php\" class=\"w3-bar-item w3-button\">Dashboard</a>\n";
    }


    echo "<a onclick=\"document.getElementById('help').style.display='block'\" class=\"w3-bar-item w3-button w3-right w3-hover-white\"><i class=\"fa fa-question-circle-o\"></i></a>\n";
      echo "</div>\n";

        # Small
        echo "<div id=\"small_nav\" class=\"w3-bar-block w3-border w3-light-gray w3-hide w3-hide-large w3-hide-medium\">\n";
                gen_dropdown($cur);
        echo "</div>\n";
        echo "<div id=\"big_nav\" class=\"w3-bar-block w3-border w3-light-gray w3-hide w3-hide-small\">\n";
                gen_dropdown($cur);
        echo "</div>\n";
      echo "</div>\n";



echo "<script>
function small_drop() {
    var x = document.getElementById(\"small_nav\");
    if (x.className.indexOf(\"w3-show\") == -1) {
        x.className += \" w3-show\";
    } else {
        x.className = x.className.replace(\" w3-show\", \"\");
    }
}

function big_drop() {
    var x = document.getElementById(\"big_nav\");
    if (x.className.indexOf(\"w3-show\") == -1) {
        x.className += \" w3-show\";
    } else {
        x.className = x.className.replace(\" w3-show\", \"\");
    }
}
</script>
<!-------------------------------------------------------------------------------------------------------------------------------------------------->\n";

}

?>
