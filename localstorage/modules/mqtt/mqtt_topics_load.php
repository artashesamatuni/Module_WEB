<?php
echo "<br/>
      <div class=\"w3-row-padding w3-container\">";
$conn = Connect();
echo "<table class=\"w3-table w3-border\">
            <tr>
                <td><b>Name</b></td>
                <td><b>Topic</b></td>
            </tr>\n";
$sql = "SELECT id, topic_name, topic FROM mqtt_topics";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<tbody>\n";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["topic_name"]."</td>
                <td>".$row["topic"]."</td>
            </tr>\n";
    }
    echo "</tbody>\n";
}
echo "</table>
      </div>
      <br/>";
echo "<div class=\"w3-row-padding\">
        <div class=\"w3-col m12 s12\">";
$sql = "SELECT mqtt_conn FROM dev_status";
$result = $conn->query($sql);
$conn->close();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<footer class=\"w3-center ";
        if ($row["mqtt_conn"]) {
            echo "w3-green\">Connected";
        } else {
            echo "w3-red\">Disconnected";
        }
        echo "</footer>";
    }
}
echo "</div>
    </div>";

echo "<br/>";
 ?>
