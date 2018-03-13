<?php
require 'basic.php';
require 'dashboard.php';

$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=$url1");

head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>";
echo "<div>";
menu('Dashboard');
echo "<div class='w3-main' style='height: 100%; margin-top:48px;margin-bottom:64px;'>
        <div class='w3-row'>
          <div class='w3-col w3-container m4 s12'>";
          relay_panel();
echo "</div>
      <div class='w3-col w3-container m4 s12'>";
          analog_panel();
echo "</div>
      <div class='w3-col w3-container m4 s12'>";
          digital_panel();
echo "</div>
  </div>
</div>";






footer(); echo "</div>
</body>"; ?>
    <script src="lib.js" type="text/javascript"></script>
    <script src="config.js" type="text/javascript"></script>

    </html>
