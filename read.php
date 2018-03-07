<!DOCTYPE html>
<html>

<body>
    <br/>
    <table style="width:100%">
        <tr>
            <th>Name</th>
            <th>Device addr.</th>
            <th>Register addr.</th>
            <th>Register type</th>
            <th>Unit</th>
            <th>Slope</th>
            <th>Offset</th>
            <th>32 bit</th>
            <th>IEEE754</th>
            <th>Low Word First</th>
            <th>&nbsp;</th>
        </tr>
        <tbody>
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

$sql = "SELECT id, name, dev_addr FROM nods";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["dev_addr"]."</td>";
        echo "<td>".$row["reg_addr"]."</td>";
        echo "<td>".$row["reg_type"]."</td>";
        echo "<td>".$row["unit"]."</td>";
        echo "<td>".$row["slope"]."</td>";
        echo "<td>".$row["offset"]."</td>";
        echo "<td>".$row["32bit"]."</td>";
        echo "<td>".$row["iee754"]."</td>";
        echo "<td>".$row["lwf"]."</td>";
        echo "<td><input value='".$row["id"]."' data-bind='checked: r_node' type='radio'></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
        </tbody>
    </table>
    <br/>
    <button onclick="document.getElementById('add').style.display='block'">Add</button>
    <button data-bind="click: delMBUS, text: (delMBUSFetching() ? 'Deleting' : (delMBUSSuccess() ? 'Deleted' : 'Delete')), disable:delMBUSFetching"></button>
    <br/>

</body>

</html>
