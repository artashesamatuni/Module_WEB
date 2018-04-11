<?php
require_once 'localstorage/modules/basic.php';
require_once 'localstorage/modules/menu.php';
head();
echo "<style>
        .but {
            border: none;
            display: inline-block;
            outline: 0;
            padding: 0 20px;
            height: 40px;
            width: 100%;
            font-size: 16px;
            line-height: 40px;
            border-radius: 20px;
            vertical-align: middle;
            overflow: hidden;
            background-color: #f1f1f1;
            text-align: left;
            cursor: pointer;
            white-space: nowrap
        }
        .label {
            display: inline-block;
            padding: 0 20px;
            height: 40px;
            width: 100%;
            font-size: 16px;
            line-height: 40px;
            border-radius: 20px;
            background-color: #f1f1f1;
        }

        .dot {
            float: left;
            margin: 3px 17px 0 -17px;
            height: 34px;
            width: 34px;
            background-color: #9e9e9e;
            line-height: 34px;
            border-radius: 50%;
            display: inline-block;
        }

        .reddot {
            float: left;
            margin: 2px 0px 0 2px;
            height: 30px;
            width: 30px;
            background-color: #f44336;
            line-height: 30px;
            border-radius: 50%;
            display: inline-block;
        }

        .greendot {
            float: left;
            margin: 2px 0px 0 2px;
            height: 30px;
            width: 30px;
            background-color: #4CAF50;
            line-height: 30px;
            border-radius: 50%;
            display: inline-block;
        }
    </style>";
start_line();
$cur = 'Dashboard';
show_menu($cur);
echo "<div class=\"w3-main w3-border\" style=\"height: 100%; margin-top:50px;margin-bottom:80px;\">
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
