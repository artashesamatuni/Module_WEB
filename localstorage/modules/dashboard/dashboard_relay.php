<?php
require_once "localstorage/modules/connection.php";
echo "<div class='w3-panel w3-border'>
        <h4>Relay Outputs</h4>
            <form method=\"post\">
            <div id=\"relay-container\">empty</div>
        </form>
      </div>\n";
echo "<script>
var refInterval = window.setInterval('update_do()', 1000); // 1 seconds
var update_do = function() {
$.ajax({
   url: 'localstorage/modules/dashboard/dashboard_relay_update.php',
   success: function (response) {
    $('#relay-container').html(response);
   }
});
};
update_do();
</script>\n";


if (isset($_POST['do1'])) {
    save(1);
}
if (isset($_POST['do2'])) {
    save(2);
}
if (isset($_POST['do3'])) {
    save(3);
}
if (isset($_POST['do4'])) {
    save(4);
}


function save($id)
{
    $fp = fsockopen("127.0.0.1", 4927, $errno, $errstr, 30);
    if (!$fp) {
        echo "$errstr ($errno)<br />\n";
    } else {
        $str = "btn".$id;
        fwrite($fp, $str);
        fclose($fp);
    }
}

    //    <form method=\"post\" action=\"localstorage/modules/dashboard/button.php\">
?>
