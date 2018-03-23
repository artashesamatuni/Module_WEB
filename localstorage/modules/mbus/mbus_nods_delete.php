<?php
require_once '../connection.php';
$conn = Connect();
if (isset($_POST['edit'])) {
    $edit = $conn->real_escape_string($_POST['edit']);
    echo "<script>document.getElementById('edit').style.display='block';</script>";

/*

    require_once '../menu.php';
    require_once '../tabs.php';

    head();
    $cur = 'Modbus Settings';
    show_menu($cur);
    echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";
    $t_names = array("Modbus-RTU");
    $cur_tab = 0;
    draw_tabs($t_names, $cur_tab);

    echo "<div class=\"w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray\">";
    echo "<div id=\"tab0\" class=\"w3-container w3-show\">";
    echo "<div class=\"w3-container\">
      <span onclick=\"document.getElementById('id01').style.display='none'\"
      class=\"w3-button w3-display-topright\">&times;</span>
      <p>Some text in the Modal..</p>
      <p>Some text in the Modal..</p>
    </div>";
    echo "</div>
    </div>\n";
    footer();
*/
} else {
    $edit = 0;
}
if (isset($_POST['remove'])) {
    $remove = $conn->real_escape_string($_POST['remove']);
    $sql = "DELETE FROM mbus_nods
            WHERE id=".$remove."";
    if ($conn->query($sql) != true) {
        alert("ERR: " . $sql . "<br/>" . $conn->error);
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
} else {
    $remove = 0;
}

$conn->close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
