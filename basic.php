<?php
function head()
{
  echo "<!doctype html>
        <html lang='en'>
          <head>
            <meta charset='utf-8'>
            <title>EM-1044</title>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='icon' href='favicon.ico' type='image/x-icon'>
            <meta name='description' content='EM-1044>
            <meta name='author' content='EagleMON'>
            <meta name='theme-color' content='white' />
            <link rel='stylesheet' href='w3.css'>
            <link rel='stylesheet' href='spinner.css'>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
          </head>";
}

function footer()
{
  echo "<div class='w3-bottom w3-light-gray' style='max-width:1024px;min-width:350px'>
          <div class='w3-bar w3-center'>".date("h").":".date("i")." ".date("a")." ".date("l").", ".date("d")." ".date("M")." ".date("Y")."</div>
          <div class='w3-bar w3-center'>
            <h4><span class='w3-text-gray'>Eagle</span><span class='w3-text-orange'>MON</span></h4>
          </div>
        </div>";
}

function loader()
{
echo "<div class='cssload-thecube' data-bind='visible: !initialised()'>
        <div class='cssload-cube cssload-c1'></div>
        <div class='cssload-cube cssload-c2'></div>
        <div class='cssload-cube cssload-c4'></div>
        <div class='cssload-cube cssload-c3'></div>
      </div>";
}


function menu($item)
{
echo "<div class='w3-top' style='max-width:1024px;min-width:350px'>
      <div class='w3-light-gray w3-bar'>
          <div id='small_menu' class='w3-top w3-bar-block w3-white w3-border w3-hide w3-hide-large w3-hide-medium'>
              <a href='javascript:void(0)' class='w3-bar-item w3-button' onclick='smallMenu()'><i class='fa fa-window-close-o'></i></a>
              <a href='analog_c.html' class='w3-bar-item w3-button'>Analog Inputs</a>
              <a href='input_c.html' class='w3-bar-item w3-button'>Digital Inputs</a>
              <a href='relay_c.html' class='w3-bar-item w3-button'>Digital Outputs</a>
              <hr/>
              <a href='mqtt_c.html' class='w3-bar-item w3-button'>MQTT Settings</a>
              <a href='mbus_c.php' class='w3-bar-item w3-button'>Modbus Settings</a>
              <a href='login_c.html' class='w3-bar-item w3-button'>Access control</a>
              <a href='config_c.html' class='w3-bar-item w3-button'>Settings</a>
              <a onclick='document.getElementById('help').style.display='block'' class='w3-bar-item w3-button'>Help</a>
          </div>
          <a href='javascript:void(0)' class='w3-bar-item w3-button w3-left w3-hide-large w3-hide-medium' onclick='smallMenu()'><i class='fa fa-navicon'></i></a>
          <div class='w3-right'>
              <a href='index.html' class='w3-bar-item w3-button'>Dashboard</a>
              <div class='w3-dropdown-click w3-hide-small'>
                  <button class='w3-button' onclick='dropdown()'>Configuration&nbsp;<i class='fa fa-caret-down'></i></button>
                  <div id='config_menu' class='w3-dropdown-content w3-bar-block w3-border' style='z-index:10'>
                      <a href='analog_c.html' class='w3-bar-item w3-button'>Analog Inputs</a>
                      <a href='input_c.html' class='w3-bar-item w3-button'>Digital Inputs</a>
                      <a href='relay_c.html' class='w3-bar-item w3-button'>Digital Outputs</a>
                      <hr/>
                      <a href='mqtt_c.html' class='w3-bar-item w3-button'>MQTT Settings</a>
                      <a href='mbus_c.php' class='w3-bar-item w3-button'>Modbus Settings</a>
                      <a href='login_c.html' class='w3-bar-item w3-button'>Access control</a>
                      <a href='config_c.html' class='w3-bar-item w3-button'>Setings</a>
                  </div>
              </div>
              <a onclick='document.getElementById('help').style.display='block'' class='w3-bar-item w3-button w3-hide-small'>Help</a>
              <a href='http://www.eaglemon.com' target='_blank' class='w3-bar-item w3-right'>
                  <image alt='logo' src='images/logo_s.png' style='height: 24px' />
              </a>
          </div>
      </div>
  </div>";
}

?>
