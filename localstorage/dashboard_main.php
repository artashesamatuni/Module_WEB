<?php
require_once 'localstorage/modules/basic.php';
require_once 'localstorage/modules/menu.php';
head();
start_line();
$cur = 'Dashboard';
show_menu($cur);
echo "<div class=\"w3-main w3-card\" style=\"height: 100%; margin-top:50px;margin-bottom:80px;\">
<div class='w3-row'>
<div class='w3-col w3-container m6 s12'>";
require 'localstorage/modules/dashboard/dashboard_relay.php';
echo "</div>
<div class='w3-col w3-container m6 s12'>";
require 'localstorage/modules/dashboard/dashboard_digital.php';
echo "</div>
</div>\n";
echo "<div class='w3-row'>
<div class='w3-col w3-container m12 s12'>";
require 'localstorage/modules/dashboard/dashboard_analog.php';
echo "</div>
</div>\n";
echo "<div class='w3-row'>
<div class='w3-col w3-container m12 s12'>";
require 'localstorage/modules/dashboard/dashboard_mbus.php';
echo "</div>
    </div>
</div>\n";
footer();
$id = 'help';
$label = "Test Help";
$body = "<h1>Test</h1>\n";
modal($id,$label,$body);
end_line();

?>
