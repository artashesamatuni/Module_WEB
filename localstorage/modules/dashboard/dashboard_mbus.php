<?php
require_once 'localstorage/modules/basic.php';
echo "<div class='w3-panel w3-border'>
        <h4>Modbus Nods</h4>
        <div id=\"mbus-container\"></div>
        <br/>
    </div>\n";
    echo "<script>
    var refInterval = window.setInterval('update_mbus()', 1000); // 1 seconds
    var update_mbus = function() {
        $.ajax({
           url: 'localstorage/modules/dashboard/dashboard_mbus_update.php',
           success: function (response) {
            $('#mbus-container').html(response);
           }
       });
    };
    update_mbus();
    </script>\n";
 ?>
