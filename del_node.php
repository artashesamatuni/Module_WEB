<?php


if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'insert':
            insert();
            break;
        case 'select':
            select();
            break;
    }
}

function select($id) {
    echo "The select function is called.".$id."-----";
    exit;
}

function insert() {
    echo "The insert function is called.";
    exit;
}



















function del_node($id)
{
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // sql to delete a record
    $sql = "DELETE FROM nods WHERE id=".$id;

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
