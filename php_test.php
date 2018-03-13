<?php
$servername = "localhost";
$username = "eaglemon";
$password = "eaglemon";
$dbname = "eaglemon";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
add_ai($conn);

function add_ai($conn)
{
$sql = "DROP TABLE ai_configs";
if ($conn->query($sql) === TRUE) {
    echo "Table nods created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$sql = "CREATE TABLE ai_configs (
id  INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name TEXT,
enabled TINYINT,
unit TEXT,
min REAL,
max REAL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table nods created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
 $sql = "INSERT INTO ai_configs (name,enabled,unit,min,max)
VALUES ('Pump',1,'L',0,5)";
    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 $sql = "INSERT INTO ai_configs (name,enabled,unit,min,max)
VALUES ('Pump 2',1,'L',0,10)";
    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 $sql = "INSERT INTO ai_configs (name,enabled,unit,min,max)
VALUES ('Motor 2',1,'RPM',0,100)";
    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
} 
 $sql = "INSERT INTO ai_configs (name,enabled,unit,min,max)
VALUES ('Temperature',1,'C',0,35)";
    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

/*
$sql = "DROP TABLE relay";

if ($conn->query($sql) === TRUE) {
    echo "Table nods deleted successfully";
} else {
    echo "Error deleting table: " . $conn->error;
}
echo "<br/>";

$sql = "CREATE TABLE relay (
id  INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
status       tinyint(1)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table nods created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
echo "<br/>";
 $sql = "INSERT INTO relay (status)
VALUES (0)";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
echo "<br/>";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
echo "<br/>";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
echo "<br/>";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
echo "<br/>";

*/

   /*

$sql = "DROP TABLE nods";

if ($conn->query($sql) === TRUE) {
    echo "Table nods deleted successfully";
} else {
    echo "Error deleting table: " . $conn->error;
}

   */

    /*
// sql to create table
$sql = "CREATE TABLE reg_type (
id INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
label VARCHAR(30) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table nods created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

 $sql = "INSERT INTO reg_type (label)
VALUES ('Coil')";

if ($conn->query($sql) === TRUE) {
    echo "1 New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
     $sql = "INSERT INTO reg_type (label)
VALUES ('Discret input')";

if ($conn->query($sql) === TRUE) {
    echo "2 New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
     $sql = "INSERT INTO reg_type (label)
VALUES ('Holding register')";

if ($conn->query($sql) === TRUE) {
    echo "3 New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
     $sql = "INSERT INTO reg_type (label)
VALUES ('Input register')";

if ($conn->query($sql) === TRUE) {
    echo "4 New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


   */



    /*
// sql to create table
$sql = "CREATE TABLE network (
id INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
dhcp VARCHAR(30) NOT NULL,
ip INT(16) NOT NULL,
mask INT(16) NOT NULL,
gateway INT(16) NOT NULL,
broadcast VARCHAR(16),
nameserver VARCHAR(120),
domain VARCHAR(120),
search VARCHAR(120)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table nods created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


    */
    /*
$sql = "DROP TABLE mbus";

if ($conn->query($sql) === TRUE) {
    echo "Table nods deleted successfully";
} else {
    echo "Error deleting table: " . $conn->error;
}
echo "<br/>";

$sql = "CREATE TABLE mbus (
baud_rate       ENUM('4800','9600','19200','38400','57600','115200','128000') NOT NULL,
parity          ENUM('even','odd','null') NOT NULL,
stop_bits       ENUM('1','2') NOT NULL,
data_bits       ENUM('7','8') NOT NULL,
read_interval   INT(16) NOT NULL,
read_timeout    INT(16) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table nods created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
echo "<br/>";
 $sql = "INSERT INTO mbus (baud_rate, parity, stop_bits,data_bits,read_interval,read_timeout)
VALUES ('9600', 'null','1','8',15,1)";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
echo "<br/>";
*/

    /*

// sql to create table
$sql = "CREATE TABLE nods (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
dev_name VARCHAR(30) NOT NULL,
dev_addr INT(3) NOT NULL,
reg_addr INT(3) NOT NULL,
reg_type ENUM('Coil','Discrete input','Holding register','Input register') NOT NULL,
unit VARCHAR(12),
slope FLOAT(8,5),
offset FLOAT(8,5),
bit32 tinyint(1),
ieee754 tinyint(1),
lwf tinyint(1)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table nods created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

*/

/*

 $sql = "INSERT INTO nods (dev_name, dev_addr, reg_addr,reg_type,unit,slope,offset,bit32,ieee754,lwf)
VALUES ('222 555', 222,333,'Coil','abc',0.03,0.11,1,0,0)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    */
$conn->close();

?>
