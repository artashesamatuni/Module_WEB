<?php
require_once '../connection.php';
require_once '../basic.php';
$conn = Connect();
if (isset($_POST['edit'])) {
    $edit = $conn->real_escape_string($_POST['edit']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
echo "

<div id=\"id01\" class=\"w3-modal\">
  <div class=\"w3-modal-content\">
    <div class=\"w3-container\">
      <span onclick=\"document.getElementById('id01').style.display='none'\"
      class=\"w3-button w3-display-topright\">&times;</span>
      <p>Some text in the Modal..</p>
      <p>Some text in the Modal..</p>
    </div>
  </div>
</div>";

echo "<script>
var modal = document.getElementById('id01');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = \"none\";
    }
}
</script>";

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
echo $edit;
echo $remove;
$conn->close();
?>
