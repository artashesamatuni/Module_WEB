<?php
require 'connection.php';
require 'del_node.php';
$conn    = Connect(); ?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>EM-1044</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <meta name="description" content="EM-1044">
        <meta name="author" content="EagleMON">
        <meta name="theme-color" content="#000000" />
        <link rel="stylesheet" href="w3.css">
        <link rel="stylesheet" href="spinner.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body class="w3-content" style="max-width:1024px;min-width:350px">
        <div class="cssload-thecube" data-bind="visible: !initialised()">
            <div class="cssload-cube cssload-c1"></div>
            <div class="cssload-cube cssload-c2"></div>
            <div class="cssload-cube cssload-c4"></div>
            <div class="cssload-cube cssload-c3"></div>
        </div>
        <div data-bind="visible: initialised" style="display: none">
            <!---------------------------------------------------------------- MENU ------------------------------------------------------------------------------------------------------------>
            <div class="w3-top" style="max-width:1024px;min-width:350px">
                <div class="w3-light-gray w3-bar">
                    <div id="small_menu" class="w3-top w3-bar-block w3-white w3-border w3-hide w3-hide-large w3-hide-medium">
                        <a href="javascript:void(0)" class="w3-bar-item w3-button" onclick="smallMenu()"><i class="fa fa-window-close-o"></i></a>
                        <a href="analog_c.html" class="w3-bar-item w3-button">Analog Inputs</a>
                        <a href="input_c.html" class="w3-bar-item w3-button">Digital Inputs</a>
                        <a href="relay_c.html" class="w3-bar-item w3-button">Digital Outputs</a>
                        <hr/>
                        <a href="mqtt_c.html" class="w3-bar-item w3-button">MQTT Settings</a>
                        <a href="login_c.html" class="w3-bar-item w3-button">Access control</a>
                        <a href="config_c.html" class="w3-bar-item w3-button">Settings</a>
                        <a onclick="document.getElementById('help').style.display='block'" class="w3-bar-item w3-button">Help</a>
                    </div>
                    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-left w3-hide-large w3-hide-medium" onclick="smallMenu()"><i class="fa fa-navicon"></i></a>
                    <div class="w3-right">
                        <a href="index.html" class="w3-bar-item w3-button">Dashboard</a>
                        <div class="w3-dropdown-click w3-hide-small">
                            <button class="w3-button" onclick="dropdown()">Configuration&nbsp;<i class="fa fa-caret-down"></i></button>
                            <div id="config_menu" class="w3-dropdown-content w3-bar-block w3-border" style="z-index:10">
                                <a href="analog_c.html" class="w3-bar-item w3-button">Analog Inputs</a>
                                <a href="input_c.html" class="w3-bar-item w3-button">Digital Inputs</a>
                                <a href="relay_c.html" class="w3-bar-item w3-button">Digital Outputs</a>
                                <hr/>
                                <a href="mqtt_c.html" class="w3-bar-item w3-button">MQTT Settings</a>
                                <a href="login_c.html" class="w3-bar-item w3-button">Access control</a>
                                <a href="config_c.html" class="w3-bar-item w3-button">Setings</a>
                            </div>
                        </div>
                        <a onclick="document.getElementById('help').style.display='block'" class="w3-bar-item w3-button w3-hide-small">Help</a>
                        <a href="http://www.eaglemon.com" class="w3-bar-item w3-right">
                            <image alt="logo" src="images/logo_s.png" style="height: 24px" />
                        </a>
                    </div>
                </div>
            </div>
            <!---------------------------------------------------------------- BODY ------------------------------------------------------------------------------------------------------------>
            <div class="w3-main" style="height: 100%; margin-top:48px;margin-bottom:64px;">
                <div class="w3-panel">
                    <div class="w3-row w3-light-gray">
                        <div class="w3-col  m6 s6">
                            <button onclick="MQTT_REPORT_CONFIG()" class="w3-button w3-block w3-light-gray w3-border-right w3-border-left w3-border-top" id="b0">Modbus-RTU</button>
                        </div>
                        <div class="w3-col m6 s6">
                            <button onclick="MQTT_CHANNELS_TOPICS()" class="w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-top w3-border-bottom" id="b1">Channels</button>
                        </div>
                    </div>
                    <div class="w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray">
                        <div id="t0" class="w3-show">
                            <?php
                                $sql = "SELECT baud_rate, parity, stop_bits,data_bits,read_interval,read_timeout FROM mbus";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<br/>
                                            <form method='post' action='save_mbus.php'>
                                                <br/>
                                                <input type='checkbox' />Enabled
                                                <br/>
                                                <br/>Baud Rate<br/>
                                                <select name='baud_rate' value='".$row["baud_rate"]."'>
                                                <option>4800</option>
                                                <option>9600</option>
                                                <option>19200</option>
                                                <option>38400</option>
                                                <option>57600</option>
                                                <option>115200</option>
                                                <option>128000</option>
                                            </select>
                                                <br/>Parity<br/>
                                                <select name='parity' value='".$row["parity"]."'>
                                                <option>even</option>
                                                <option>odd</option>
                                                <option>none</option>
                                            </select>
                                                <br/>Stop Bits<br/>
                                                <select name='stop_bits' value='".$row["stop_bits"]."'>
                                                <option>1</option>
                                                <option>2</option>
                                            </select>
                                                <br/>Data Bits<br/>
                                                <select name='data_bits' value='".$row["data_bits"]."'>
                                                <option>7</option>
                                                <option>8</option>
                                            </select>
                                                <br/>Read Interval[sec.]<br/>
                                                <input name='read_interval' type='number' min='1' max='300' value='".$row["read_interval"]."' />
                                                <br/>Read Timeout[sec.]<br/>
                                                <input name='read_timeout' type='number' min='1' max='5' value='".$row["read_timeout"]."' />
                                                <br/><br/>
                                                <input type='submit' value='Submit' />
                                            </form>
                                            <br/>";                
                                    }
                                } else {
                                echo "0 results";
                                }
                                ?>
                        </div>
                        <div id="t1" class="w3-hide">
                            <?php
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
                            $sql = "SELECT id, dev_name, dev_addr, reg_addr,reg_type,unit,slope,offset,bit32,ieee754,lwf FROM nods";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>".$row["id"]."</td>";
                                    echo "<td>".$row["dev_name"]."</td>";
                                    echo "<td>".$row["dev_addr"]."</td>";
                                    echo "<td>".$row["reg_addr"]."</td>";
                                    echo "<td>".$row["reg_type"]."</td>";
                                    echo "<td>".$row["unit"]."</td>";
                                    echo "<td>".$row["slope"]."</td>";
                                    echo "<td>".$row["offset"]."</td>";
                                    if ($row["bit32"])
                                        echo "<td>Enable</td>";
                                    else
                                        echo "<td>Disable</td>";
                                    if ($row["ieee754"])
                                        echo "<td>Enable</td>";
                                    else
                                        echo "<td>Disable</td>";
                                    if ($row["lwf"])
                                        echo "<td>Enable</td>";
                                    else
                                        echo "<td>Disable</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "0 results";
                            }
                            echo "</tbody>
                                </table>
                                <br/>";
                        ?>
                                <button onclick="document.getElementById('add').style.display='block'">Add</button>

                                <?php
 if($_GET['del']){fun1();}

 function fun1()
 {
    $sql = "DELETE FROM nods WHERE id=1";
 }
 function fun2()
 {
   //This function will update some column in database to 2
 }
?>
                                    <button id="btndel" name="btndel" onClick='location.href="?1"'>Delete</button>
                                    <br/>

                        </div>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------------------------------------------------------------------------------------->
        <div id="add" class="w3-modal">
            <div class="w3-modal-content">
                <button class="w3-right" onclick="document.getElementById('add').style.display='none'" class="w3-display-topright">&times;</button>
                <div class="w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray">
                    <h4>Add new Modbus unit</h4>
                    <form method="post" action="new_node.php">
                        Name<br/>
                        <input type="text" max="10" name="dev_name" />
                        <br/>Device addr.<br/>
                        <input type="number" name="dev_addr" />
                        <br/>Register addr.<br/>
                        <input type="number" name="reg_addr" />
                        <br/>Register type<br/>
                        <select name="reg_type">
<?php
$sql = "SELECT id,label FROM reg_type";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row["id"]."'>".$row["label"]."</option>";                
    }
} else {
echo "0 results";
}

?>                       

                    </select>
                        <br/>Unit<br/>
                        <input type="text" name="unit" />
                        <br/>Slope<br/>
                        <input type="number" name="slope" value="1" />
                        <br/>Offset<br/>
                        <input type="number" name="offset" value="1" />
                        <br/>
                        <input type="hidden" name="bit32" value="0" />
                        <input type="checkbox" name="bit32" value="1" />&nbsp;32 bit Enable<br/>
                        <input type="hidden" name="ieee754" value="0" />
                        <input type="checkbox" name="ieee754" value="1" />&nbsp;IEEE754<br/>
                        <input type="hidden" name="lwf" value="0" />
                        <input type="checkbox" name="lwf" value="1" />&nbsp;Low Word First<br/>
                        <br/>
                        <input type="submit" value="Submit" />
                        <br/>
                        <br/>
                    </form>
                </div>
            </div>
        </div>
        <!---------------------------------------------------------------- FOOTER ------------------------------------------------------------------------------------------------------------>
        <div class="w3-bottom w3-light-gray" style="max-width:1024px;min-width:350px">
            <div class="w3-bar w3-center">
                <snap data-bind="text: status.showTime()">time</snap>
                <snap data-bind="text: status.showDate()">date</snap>
            </div>
            <div class="w3-bar w3-center">Eagle<span class="w3-text-orange">MON</span></div>
        </div>
    </body>
    <?php $conn->close(); ?>
    <script src="lib.js" type="text/javascript"></script>
    <script src="config.js" type="text/javascript"></script>
    <script type="text/javascript">
        function MQTT_REPORT_CONFIG() {
            var x = document.getElementById("t0");
            if (x.className.indexOf("w3-show") == -1) {
                x.className = " w3-show w3-light-gray";
                document.getElementById("b0").className = "w3-button w3-block w3-border-right w3-border-left w3-border-top w3-light-gray w3-text-black";
                document.getElementById("b1").className = "w3-button w3-block w3-border-right w3-border-top w3-border-bottom w3-gray w3-text-white";
                document.getElementById("t1").className = "w3-hide";
            }
        }

        function MQTT_CHANNELS_TOPICS() {
            var x = document.getElementById("t1");
            if (x.className.indexOf("w3-show") == -1) {
                x.className = " w3-show";
                document.getElementById("b0").className = "w3-button w3-block w3-border-right w3-border-left w3-border-top w3-border-bottom w3-gray w3-text-white";
                document.getElementById("b1").className = "w3-button w3-block w3-border-right w3-border-top w3-light-gray w3-text-black";
                document.getElementById("t0").className = "w3-hide";
            }
        }

    </script>

    </html>
