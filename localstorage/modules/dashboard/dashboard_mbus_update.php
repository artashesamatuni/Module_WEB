<?php
    require_once "../connection.php";
    $conn    = Connect();
    $sql = "SELECT mbus_nods.name, mbus_nods.unit, mbus_nods_values.value
    FROM mbus_nods
    INNER JOIN mbus_nods_values
    ON mbus_nods.id=mbus_nods_values.id";
    $result = $conn->query($sql);
    $conn->close();
    echo "<table class=\"w3-table\">
            <tr class=\"w3-light-gray\">
              <td>Node</td>
              <td>Value</td>
            </tr>\n";
    if ($result->num_rows > 0) {
        echo "<tbody>\n";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["name"]."</td>
                    <td>".$row["value"]." ".$row["unit"]."</td>
                 </tr>\n";
        }
        echo "</tbody>\n";
    }
    echo "</table>";
?>
