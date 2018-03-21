<?php
require_once 'modules/basic.php';
require_once 'modules/menu.php';
head();
start_line();
echo "<div>";
$cur = 'Dashboard';
show_menu($cur);
echo "<div class='w3-main' style='height: 100%; margin-top:48px;margin-bottom:64px;'>
<div class='w3-row'>
<div class='w3-col w3-container m6 s12'>";
require 'localstorage/modules/relay.php';
echo "</div>
<div class='w3-col w3-container m6 s12'>";
require 'localstorage/modules/digital.php';
echo "</div>
</div>\n";
echo "<div class='w3-row'>
<div class='w3-col w3-container m12 s12'>";
require 'localstorage/modules/analog.php';
echo "</div>
</div>\n";
echo "<div class='w3-row'>
<div class='w3-col w3-container m12 s12'>";
require 'localstorage/modules/mbus.php';
echo "</div>
</div>\n";
    footer();
    $id = 'help';
    $label = "Test Help";
    $body = "<h1>Test</h1>\n";
    modal($id,$label,$body);

end_line();

?>
