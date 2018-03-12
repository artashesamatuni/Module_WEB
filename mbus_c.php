<?php
require 'basic.php';
require 'mbus_nodes.php';
require 'del_node.php';
head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>";
loader();
echo "<div data-bind='visible: initialised' style='display: none'>";
menu('Dashboard');
 ?>
            <div class="w3-main" style="height: 100%; margin-top:48px;margin-bottom:64px;">
                <div class="w3-panel">
                    <div class="w3-row w3-light-gray">
                        <div class="w3-col  m6 s6">
                            <button onclick="MQTT_REPORT_CONFIG()" class="w3-button w3-block w3-light-gray w3-border-right w3-border-left w3-border-top" id="b0">Modbus-RTU</button>
                        </div>
                        <div class="w3-col m6 s6">
                            <button onclick="MQTT_CHANNELS_TOPICS()" class="w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-top w3-border-bottom" id="b1">Channels</button>
                        </div>
                    </div>
                    <div class="w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray">
                        <div id="t0" class="w3-show">
                          <?php mbus_config(); ?>
                        </div>
                        <div id="t1" class="w3-hide">
                            <?php show_nodes(); ?>
                                <button onclick="document.getElementById('add').style.display='block'">Add</button>
                                <br/>

                        </div>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------------------------------------------------------------------------------------->
        <div id="add" class="w3-modal">
            <div class="w3-modal-content">
              <button class="w3-right" onclick="document.getElementById('add').style.display='none'" class="w3-display-topright">&times;</button>
              <?php new_node(); ?>
            </div>
        </div>
        <!---------------------------------------------------------------- FOOTER ------------------------------------------------------------------------------------------------------------>
        <?php footer(); ?>
        </div>
    </body>

    <script src="lib.js" type="text/javascript"></script>
    <script src="config.js" type="text/javascript"></script>
    <script type="text/javascript">
        function MQTT_REPORT_CONFIG() {
            var x = document.getElementById("t0");
            if (x.className.indexOf("w3-show") == -1) {
                x.className = " w3-show w3-light-gray";
                document.getElementById("b0").className = "w3-button w3-block w3-border-right w3-border-left w3-border-top w3-light-gray w3-text-black";
                document.getElementById("b1").className = "w3-button w3-block w3-border-right w3-border-top w3-border-bottom w3-gray w3-text-white";
                document.getElementById("t1").className = "w3-hide";
            }
        }

        function MQTT_CHANNELS_TOPICS() {
            var x = document.getElementById("t1");
            if (x.className.indexOf("w3-show") == -1) {
                x.className = " w3-show";
                document.getElementById("b0").className = "w3-button w3-block w3-border-right w3-border-left w3-border-top w3-border-bottom w3-gray w3-text-white";
                document.getElementById("b1").className = "w3-button w3-block w3-border-right w3-border-top w3-light-gray w3-text-black";
                document.getElementById("t0").className = "w3-hide";
            }
        }

    </script>

    </html>
