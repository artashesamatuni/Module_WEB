<?php
require 'localstorage/modules/basic.php';
require 'localstorage/modules/menu.php';
require 'localstorage/modules/connection.php';


head();
start_line();

$conn    = Connect();
//drop_table($conn);
//add_table($conn);
//add_data($conn);

echo "<form>";
echo "<table>";
$sql = "SELECT id, rl, start, stop FROM rl_shedule";
$result = $conn->query($sql);
$conn->close();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
echo "<tr>";
  echo "<td><input type=\"time\" name=\"start".$row["id"]."\"  value=\"".$row["start"]."\"></td>";
  echo "<td><input type=\"time\" name=\"stop".$row["id"]."\"  value=\"".$row["stop"]."\"></td>";
  echo "</tr>";


}
}

echo "</table>";
echo "</form>";
footer();
end_line();




function drop_table($conn) {
    $sql = "DROP TABLE rl_shedule";

    if ($conn->query($sql) === TRUE) {
        echo "Table nods deleted successfully";
    } else {
        echo "Error deleting table: " . $conn->error;
    }
}

function add_table($conn) {
    $sql = "CREATE TABLE rl_shedule (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    rl INT UNSIGNED NOT NULL,
    start VARCHAR(16) NOT NULL,
    stop VARCHAR(16) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table nods created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

}

function add_data($conn)
{

    $sql   = "INSERT INTO rl_shedule (rl, start, stop )
    VALUES (1,'17:15','21:45')";

    if ($conn->query($sql) === TRUE) {
        echo "Line added successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

?>
