<?php
    require_once "../connection.php";
    require_once "../soc.php";
    $conn    = Connect();
    $sql = "SELECT mbus_nods.id, mbus_nods.name, mbus_nods.unit, mbus_nods_values.value
    FROM mbus_nods
    INNER JOIN mbus_nods_values
    ON mbus_nods.id=mbus_nods_values.id";
    $result = $conn->query($sql);
    $conn->close();
    echo "<table class=\"w3-table\">
            <tr class=\"w3-light-gray\">
              <td style=\"width:70%\">Node</td>
              <td style=\"width:15%\">Value</td>
              <td style=\"width:15%\">Unit</td>
            </tr>\n";
    if ($result->num_rows > 0) {
        $msg = "get_mbus_".$row['id'];
        $val = get($msg);
        echo "<tbody>\n";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["name"]."</td>
                    <td>".round($val,2)."</td>
                    <td>".$row["unit"]."</td>
                 </tr>\n";
        }
        echo "</tbody>\n";
    }
    echo "</table>";
?>
