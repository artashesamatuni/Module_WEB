<?php
require_once 'localstorage/modules/basic.php';
echo "<div class='w3-panel w3-border'>
        <h4>Analog Inputs</h4>
        <div id=\"analog-container\">empty</div>
        <br/>
    </div>\n";
    echo "<script>
    var refInterval = window.setInterval('update_ai()', 1000); // 1 seconds
    var update_ai = function() {
        $.ajax({
           url: 'localstorage/modules/dashboard/dashboard_analog_update.php',
           success: function (response) {
            $('#analog-container').html(response);
           }
       });
    };
    update_ai();
    </script>\n";
 ?>
