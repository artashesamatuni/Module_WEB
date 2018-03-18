<?php

    $conn    = Connect();
    echo "<br/>\n";
    echo "<form method=\"post\">\n";
    echo "<table class=\"w3-table w3-border\">
        <tr class=\"w3-gray\">
          <th>Name</th>
          <th>Dev. addr.</th>
          <th>Reg. addr.</th>
          <th></th>
        </tr>\n";

    $sql = "SELECT name, dev_addr, reg_addr FROM mbus_nods";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<tbody>\n";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>\n";
            echo "<td>".$row["name"]."</td>\n";
            echo "<td>".$row["dev_addr"]."</td>\n";
            echo "<td>".$row["reg_addr"]."</td>\n";
            echo "<td><button type=\"submit\" name=\"edit".$row["id"]."\" class=\"w3-button w3-right w3-gray w3-text-white w3-card-4\"><i class=\"fa fa-edit\"></i></button>\n";
            echo "<button type=\"submit\" name=\"delete".$row["id"]."\" class=\"w3-button w3-right w3-red w3-card-4\"><i class=\"fa fa-close\"></i></button></td>\n";
            echo "</tr>\n";
        }
        echo "</tbody>\n";
    } else {
        echo "No data";
    }
    echo "</table>\n";
    echo "</form>
      <br/>\n";
    $conn->close();
