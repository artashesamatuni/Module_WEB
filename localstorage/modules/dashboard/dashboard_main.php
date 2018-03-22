<?php
require_once 'localstorage/modules/basic.php';
require_once 'localstorage/modules/menu.php';
head();
start_line();
echo "<div>";
$cur = 'Dashboard';
show_menu($cur);
echo "<div class='w3-main' style='height: 100%; margin-top:48px;margin-bottom:64px;'>
<div class='w3-row'>
<div class='w3-col w3-container m6 s12'>";
require 'dashboard_relay.php';
echo "</div>
<div class='w3-col w3-container m6 s12'>";
require 'dashboard_digital.php';
echo "</div>
</div>\n";
echo "<div class='w3-row'>
<div class='w3-col w3-container m12 s12'>";
require 'dashboard_analog.php';
echo "</div>
</div>\n";
echo "<div class='w3-row'>
<div class='w3-col w3-container m12 s12'>";
require 'dashboard_mbus.php';
echo "</div>
</div>\n";
footer();
$id = 'help';
$label = "Test Help";
$body = "<h1>Test</h1>\n";
modal($id,$label,$body);
end_line();

?>
