<?php
require_once 'localstorage/modules/basic.php';
echo "<div class='w3-panel w3-border'>
        <h4>Digital Input</h4>
        <form>
        <div id=\"digital-container\">empty</div>
        </form>
    </div>\n";
echo "<script>
var refInterval = window.setInterval('update_di()', 1000); // 1 seconds
var update_di = function() {
    $.ajax({
       url: 'localstorage/modules/dashboard/dashboard_digital_update.php',
       success: function (response) {
        $('#digital-container').html(response);
       }
   });
};
update_di();
</script>\n";


 ?>
