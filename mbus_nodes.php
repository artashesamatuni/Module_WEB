<?php
require 'connection.php';


function mbus_config()
{
  $conn    = Connect();
  echo "<br/>
      <form method='post' action='save_mbus.php'>";
      $mbus_sql = "SELECT enabled, baud_rate, parity, stop_bits,data_bits,read_interval,read_timeout FROM mbus";
      $mbus_result = $conn->query($mbus_sql);
      if ($mbus_result->num_rows > 0) {
          while($mbus_row = $mbus_result->fetch_assoc()) {
          echo "<br/>".$mbus_row["enabled"]."<br/>";
          echo "<input type='hidden' name='enabled' value='0' />";
          echo "<input name='enabled' type='checkbox' value='";
          if ($mbus_row["enabled"]==0)
          echo "0'/>Enabled<br/>";
          else
          echo "1' checked/>Enabled<br/>";

          echo "<br/>Baud Rate<br/>";
          echo "<select name='baud_rate' value='".$mbus_row["baud_rate"]."'>";
          $baud_rates_sql = "SELECT id,baud_rates FROM mbus_baud_rates";
          $baud_rates_result = $conn->query($baud_rates_sql);

          if ($baud_rates_result->num_rows > 0) {
              while($baud_rates_row = $baud_rates_result->fetch_assoc()) {
                  if($mbus_row["baud_rate"]==$baud_rates_row["baud_rates"]) {
                  echo "<option value='".$baud_rates_row["baud_rates"]."' selected>".$baud_rates_row["baud_rates"]."</option>";
                  }
                  else {
                      echo "<option value='".$baud_rates_row["baud_rates"]."'>".$baud_rates_row["baud_rates"]."</option>";
                  }

              }
          } else {
          echo "0 results";
          }
          echo "</select>";
  //-------------------------------------------------------------------------------------------------------------------------------------
          echo "<br/>Parity<br/>";
          echo "<select name='parity' value='".$mbus_row["parity"]."'>";
          $parity_sql = "SELECT id,parity FROM mbus_parity";
          $parity_result = $conn->query($parity_sql);

          if ($parity_result->num_rows > 0) {
              while($parity_row = $parity_result->fetch_assoc()) {
                  if($mbus_row["parity"]==$parity_row["parity"]) {
                  echo "<option value='".$parity_row["parity"]."' selected>".$parity_row["parity"]."</option>";
                  }
                  else {
                  echo "<option value='".$parity_row["parity"]."'>".$parity_row["parity"]."</option>";
                  }
              }
          } else {
          echo "0 results";
          }
          echo "</select>";
  //-------------------------------------------------------------------------------------------------------------------------------------
          echo "<br/>Stop Bits<br/>";
          echo "<select name='stop_bits' value='".$mbus_row["stop_bits"]."'>";
          $stop_bits_sql = "SELECT id, stop_bits FROM mbus_stop_bits";
          $stop_bits_result = $conn->query($stop_bits_sql);

          if ($stop_bits_result->num_rows > 0) {
              while($stop_bits_row = $stop_bits_result->fetch_assoc()) {
                  if($mbus_row["stop_bits"]==$stop_bits_row["stop_bits"]) {
                  echo "<option value='".$stop_bits_row["stop_bits"]."' selected>".$stop_bits_row["stop_bits"]."</option>";
                  }
                  else {
                      echo "<option value='".$stop_bits_row["stop_bits"]."'>".$stop_bits_row["stop_bits"]."</option>";
                  }
              }
          } else {
          echo "0 results";
          }
          echo "</select>";
  //-------------------------------------------------------------------------------------------------------------------------------------
          echo "<br/>Data Bits<br/>";
          echo "<select name='data_bits' value='".$mbus_row["data_bits"]."'>";
          $data_bits_sql = "SELECT id, data_bits FROM mbus_data_bits";
          $data_bits_result = $conn->query($data_bits_sql);

          if ($data_bits_result->num_rows > 0) {
              while($data_bits_row = $data_bits_result->fetch_assoc()) {
                  if($mbus_row["data_bits"]==$data_bits_row["data_bits"]) {
                  echo "<option value='".$data_bits_row["data_bits"]."' selected>".$data_bits_row["data_bits"]."</option>";
                  }
                  else {
                      echo "<option value='".$data_bits_row["data_bits"]."'>".$data_bits_row["data_bits"]."</option>";
                  }

              }
          } else {
          echo "0 results";
          }
          echo "</select>";
  //-------------------------------------------------------------------------------------------------------------------------------------
          echo "<br/>Read Interval[sec.]<br/>
          <input name='read_interval' type='number' min='1' max='300' value='".$mbus_row["read_interval"]."' />
          <br/>Read Timeout[sec.]<br/>
          <input name='read_timeout' type='number' min='1' max='5' value='".$mbus_row["read_timeout"]."' />
          <br/><br/>
          <input type='submit' value='Submit' />
      </form>
      <br/>";
  }
  } else {
  echo "0 results";
  }

$conn->close();
}

function show_nodes()
{
$conn    = Connect();
echo "<br/>
      <table style='width:100%'>
          <tr>
              <th>#</th>
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
          </tr>
    <tbody>";
//-------------------------------------------------------------------------------------------
    $sql = "SELECT id, name, dev_addr, reg_addr,reg_type,unit,slope,offset,bit32,ieee754,low_first FROM mbus_nods";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc())
        {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["name"]."</td>
                    <td>".$row["dev_addr"]."</td>
                    <td>".$row["reg_addr"]."</td>
                    <td>".register_type($row["reg_type"])."</td>
                    <td>".$row["unit"]."</td>
                    <td>".$row["slope"]."</td>
                    <td>".$row["offset"]."</td>";
                    if ($row["bit32"])
                        echo "<td><input type='checkbox' checked/></td>";
                    else
                        echo "<td><input type='checkbox'/></td>";
                    if ($row["ieee754"])
                        echo "<td><input type='checkbox' checked/></td>";
                    else
                        echo "<td><input type='checkbox'/></td>";
                    if ($row["low_first"])
                        echo "<td><input type='checkbox' checked disabled/></td>";
                    else
                        echo "<td><input type='checkbox' disabled/></td>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }
//-------------------------------------------------------------------------------------------
echo "</tbody>
    </table>
    <br/>";

$conn->close();
}


function new_node() {
  echo "
  <div class='w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray'>
      <h4>Add new Modbus unit</h4>
      <form method='post' action='new_node.php'>
          Name<br/>
          <input type='text' max='10' name='name' />
          <br/>Device addr.<br/>
          <input type='number' name='dev_addr' />
          <br/>Register addr.<br/>
          <input type='number' name='reg_addr' />
          <br/>Register type<br/>
  ";
          $conn    = Connect();
            echo "<select name='reg_type'>";
            $reg_types_sql = "SELECT id, reg_types FROM mbus_reg_types";
            $reg_types_result = $conn->query($reg_types_sql);

            if ($reg_types_result->num_rows > 0) {
                while($reg_types_row = $reg_types_result->fetch_assoc()) {
                    echo "<option value='".$reg_types_row["id"]."'>".$reg_types_row["reg_types"]."</option>";
                }
            } else {
            echo "0 results";
            }
            echo "</select>";
          $conn->close();
  echo "
          <br/>Unit<br/>
          <input type='text' name='unit' />
          <br/>Slope<br/>
          <input type='number' name='slope' value='1' />
          <br/>Offset<br/>
          <input type='number' name='offset' value='0' />
          <br/>
          <input type='hidden' name='bit32' value='0' />
          <input type='checkbox' name='bit32' value='1' />&nbsp;32 bit Enable<br/>
          <input type='hidden' name='ieee754' value='0' />
          <input type='checkbox' name='ieee754' value='1' />&nbsp;IEEE754<br/>
          <input type='hidden' name='low_first' value='0' />
          <input type='checkbox' name='low_first' value='1' />&nbsp;Low Word First<br/>
          <br/>
          <input type='submit' value='Submit' />
          <br/>
          <br/>
      </form>
  </div>
  ";
}

function register_type($item)
{
  $conn    = Connect();
    echo "<select name='reg_type'>";
    $reg_types_sql = "SELECT id, reg_types FROM mbus_reg_types";
    $reg_types_result = $conn->query($reg_types_sql);
    if ($reg_types_result->num_rows > 0) {
        $reg_types_row = $reg_types_result->fetch_array($item);
      }
    else {
        echo "0 results";
      }
    echo "</select>";
  $conn->close();
  return $reg_types_row["reg_types"];
}


?>
