<?php

function gen_dropdown($cur)
{
    if ($cur!='Analog Inputs') {
        echo "<a href=\"ai_c.php\" class=\"w3-bar-item w3-button\">Analog Inputs</a>\n";
    }
    if ($cur!='Digital Inputs') {
        echo "<a href=\"di_c.php\" class=\"w3-bar-item w3-button\">Digital Inputs</a>\n";
    }
    if ($cur!='Digital Outputs') {
        echo "<a href=\"do_c.php\" class=\"w3-bar-item w3-button\">Digital Outputs</a>\n";
    }
    echo "<hr/>";
    if ($cur!='MQTT Settings') {
        echo "<a href=\"mqtt_c.php\" class=\"w3-bar-item w3-button\">MQTT Settings</a>\n";
    }
    if ($cur!='Modbus Settings') {
        echo "<a href=\"mbus_c.php\" class=\"w3-bar-item w3-button\">Modbus Settings</a>\n";
    }
    if ($cur!='Access control') {
        echo "<a href=\"login_c.php\" class=\"w3-bar-item w3-button\">Access control</a>\n";
    }
    if ($cur!='Settings') {
        echo "<a href=\"config_c.php\" class=\"w3-bar-item w3-button\">Settings</a>\n";
    }
}


function show_menu($cur)
{
    echo "<div class=\"w3-top\" style=\"max-width:1024px;min-width:350px\">
      <div class=\"w3-light-gray w3-bar\">
          <div id=\"small_menu\" class=\"w3-top w3-bar-block w3-white w3-border w3-hide w3-hide-large w3-hide-medium\">
              <a href=\"javascript:void(0)\" class=\"w3-bar-item w3-button\" onclick=\"smallMenu()\"><i class=\"fa fa-window-close-o\"></i></a>\n";
    gen_dropdown($cur);
    echo "<a onclick=\"document.getElementById(\"help\").style.display='block'\" class=\"w3-bar-item w3-button\">Help</a>
          </div>
          <a href=\"javascript:void(0)\" class=\"w3-bar-item w3-button w3-left w3-hide-large w3-hide-medium\" onclick=\"smallMenu()\"><i class=\"fa fa-navicon\"></i></a>
          <div class=\"w3-right\">\n";
    if ($cur!='Dashboard') {
        echo "<a href=\"index.php\" class=\"w3-bar-item w3-button\">Dashboard</a>\n";
    }
    echo "<div class=\"w3-dropdown-click w3-hide-small\">
                  <button class=\"w3-button\" onclick=\"dropdown()\">Configuration&nbsp;<i class=\"fa fa-caret-down\"></i></button>
                  <div id=\"config_menu\" class=\"w3-dropdown-content w3-bar-block w3-border\" style=\"z-index:10\">\n";

    gen_dropdown($cur);

    echo "</div>
              </div>
              <a onclick=\"document.getElementById('help').style.display='block'\" class=\"w3-bar-item w3-button w3-hide-small\">Help</a>
              <a href=\"http://www.eaglemon.com\" target=\"_blank\" class=\"w3-bar-item w3-right\">
                  <image alt=\"logo\" src=\"images/logo_s.png\" style=\"height: 24px\" />
              </a>
          </div>
      </div>
  </div>\n";
    include_js();
}

function include_js()
{
    echo "\n<script type='text/javascript'>\n";
    echo "function dropdown() {
      var x = document.getElementById(\"config_menu\");
      if (x.className.indexOf(\"w3-show\") == -1) {
          x.className += \" w3-show\";
      } else {
          x.className = x.className.replace(\" w3-show\", \"\");
      }
  }\n";

    echo "function smallMenu() {
      var x = document.getElementById(\"small_menu\");
      if (x.className.indexOf(\"w3-show\") == -1) {
          x.className += \" w3-show\";
      } else {
          x.className = x.className.replace(\" w3-show\", \"\");
      }
  }\n";
    echo "</script>\n";
}
