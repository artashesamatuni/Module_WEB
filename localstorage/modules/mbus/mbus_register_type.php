<?php
    $conn    = Connect();
    echo "<select name='reg_type'>";
    $reg_types_sql = "SELECT id, reg_types FROM mbus_reg_types";
    $reg_types_result = $conn->query($reg_types_sql);
    if ($reg_types_result->num_rows > 0) {
        $reg_types_row = $reg_types_result->fetch_array($item);
    } else {
        echo "0 results";
    }
    echo "</select>";
    $conn->close();
    return $reg_types_row["reg_types"];
 ?>
