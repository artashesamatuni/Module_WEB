<?php
require 'basic.php';
require 'mbus_nodes.php';
require 'del_node.php';
require 'tabs.php';
head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>\n";
loader();
echo "<div data-bind='visible: initialised' style='display: none'>\n";
menu('Dashboard');

echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";
            
$t_names = array("Modbus-RTU", "Channels");

draw_tabs($t_names,0);

 ?>
    <div class="w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray">
        <div id="tab0" class="w3-show">
            <?php mbus_config(); ?>
        </div>
        <div id="tab1" class="w3-hide">
            <?php show_nodes(); ?>
            <button onclick="document.getElementById('add').style.display='block'">Add</button>
            <br/>

        </div>
        <br/>
    </div>
    <?php
echo "</div>\n</div>\n</div>";
?>
        <!-------------------------------------------------------------------------------------------------------->
        <div id="add" class="w3-modal">
            <div class="w3-modal-content">
                <button class="w3-right" onclick="document.getElementById('add').style.display='none'" class="w3-display-topright">&times;</button>
                <?php new_node(); ?>
            </div>
        </div>
        <!---------------------------------------------------------------- FOOTER ------------------------------------------------------------------------------------------------------------>
        <?php footer(); 
echo "</body>\n";
echo "<script src=\"lib.js\" type=\"text/javascript\"></script>
      <script src=\"config.js\" type=\"text/javascript\"></script>\n";
echo "</html>";
?>
