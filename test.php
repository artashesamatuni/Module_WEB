<?php
require 'basic.php';
require 'menu.php';
require 'dashboard.php';

$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 5; URL=$url1");

head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>";
echo "<div>";
$cur = 'Dashboard';
show_menu($cur);




footer(); echo "</div>
</body>"; ?>
    <script src="lib.js" type="text/javascript"></script>
    <script src="config.js" type="text/javascript"></script>

    </html>
