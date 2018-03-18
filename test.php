<?php
require 'modules/basic.php';
require 'modules/menu.php';
require 'modules/connection.php';


head();
echo "<body class='w3-content' style='max-width:1024px;min-width:350px'>";
echo "<div class=\"w3-main\" style=\"height: 100%; margin-top:48px;margin-bottom:64px;\">\n";
$cur = 'Digital Outputs';
show_menu($cur);


$conn    = Connect();

$sql ="DROP TABLE admin";
if ($conn->query($sql) === true) {
    echo "Table deleted\n";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql= "CREATE TABLE admin (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    passcode VARCHAR(64) NOT NULL
    )";

if ($conn->query($sql) != true) {
    echo "ERR: " . $conn->error;
} else {
    echo "Table created\n";
}
$a = hash('sha256',"admin");
$sql   = "INSERT INTO admin (username, passcode) VALUES ('admin','".$a."')";


if ($conn->query($sql) === true) {
    echo "New record created successfully\n";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$a = hash('sha256',"user");
$sql   = "INSERT INTO admin (username, passcode) VALUES ('user','".$a."')";


if ($conn->query($sql) === true) {
    echo "New record created successfully\n";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$a = hash('sha256',"guest");
$sql   = "INSERT INTO admin (username, passcode) VALUES ('guest','".$a."')";


if ($conn->query($sql) === true) {
    echo "New record created successfully\n";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql = "SELECT id, username, passcode FROM admin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["username"]. " " . $row["passcode"]. "<br>";
    }
} else {
    echo "0 results";
}




$conn->close();


footer();
echo "</div>
</body>
</html>";
?>
