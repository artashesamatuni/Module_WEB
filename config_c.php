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
                    <a href="mqtt_c.html" class="w3-bar-item w3-button">MQTT Broker</a>
                    <a href="login_c.html" class="w3-bar-item w3-button">Access control</a>
                    <a href="config_c.html" class="w3-bar-item w3-button">Settings</a>
                    <a onclick="document.getElementById('help').style.display='block'" class="w3-bar-item w3-button">Help</a>
                </div>
                <a href="javascript:void(0)" class="w3-bar-item w3-button w3-left w3-hide-large w3-hide-medium" onclick="smallMenu()"><i class="fa fa-navicon"></i></a>
                <div class="w3-right">
                    <a href="index.html" class="w3-bar-item w3-button">DASHBOARD</a>
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
                    <div class="w3-col  m3 s3">
                        <button onclick="R0Menu()" class="w3-button w3-block w3-light-gray w3-border-right w3-border-left w3-border-top" id="b0">System</button>
                    </div>
                    <div class="w3-col m3 s3">
                        <button onclick="R1Menu()" class="w3-button w3-block w3-grey w3-text-white w3-border-right w3-border-top w3-border-bottom" id="b1">Network</button>
                    </div>
                    <div class="w3-col m3 s3">
                        <button onclick="R2Menu()" class="w3-button w3-block w3-grey w3-text-white w3-border-right w3-border-top w3-border-bottom" id="b2">Modbus RTU</button>
                    </div>
                    <div class="w3-col m3 s3">
                        <button onclick="R3Menu()" class="w3-button w3-block w3-grey w3-text-white w3-border-right w3-border-top w3-border-bottom" id="b3">Status</button>
                    </div>
                </div>
                <div class="w3-container w3-border-right w3-border-left w3-border-bottom w3-light-gray">
                    <div id="t0" class="w3-show">
                        <br/>
                        <div class="w3-row">
                            <div class="w3-col w3-container m12 s12">
                                <h4 class="w3-container w3-center">Your Timezone</h4>
                                <form>
                                    <select data-bind="options: tz.zones, value: $root.config.tzone"></select>Timezone<br/>
                                    <br/>
                                    <br/>
                                    <button data-bind="click: saveTZ, text: (saveTZFetching() ? 'Saving...' : (saveTZSuccess() ? 'Saved' : 'Save')), disable: saveTZFetching"></button>
                                </form>
                                <br/>
                            </div>
                        </div>
                        <br/>
                    </div>
                    <div id="t1" class="w3-hide">
                        <?php
                        require 'connection.php';
                        $conn    = Connect();

                        $sql = "SELECT dhcp, ip, mask,gateway,broadcast,nameserver,domain,search FROM network";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        
         //   $sql = "SELECT dhcp, ip, mask,gateway,broadcast,nameserver,domain,search FROM network";
        //    $result = mysql_query($sql) or die(mysql_error());
         //   while ($row    = mysql_fetch_array($result))
          //  {
//
           //     $ip         = $row['ip'];
           //     $mask       = $row['mask'];
         //       $gateway    = $row['gateway'];
        //    }
                        $conn->close();
                        echo "<b>".$row["dhcp"]."</b><br/>"; echo "<b>".$row["ip"]."</b><br/>";
                        ?>










                            <div class='w3-row'>
                                <div class='w3-col w3-container m12 s12'>
                                    <h4 class='w3-container w3-center'>Ethernet Configuration</h4>
                                    <form action="add_eth.php" method="post">
                                        <input type="checkbox" name="dhcp" value="<?php echo $row ['dhcp']; ?>" />DHCP
                                        <br/>IP*<br/><input type="text" name="ip" value="<?php echo $row ['ip']; ?>" />
                                        <br/>Netmask*<br/><input type="text" name="mask" value="<?php echo $row ['mask']; ?>" />
                                        <br/>Gateway*<br/><input type="text" name="gateway" value="<?php echo $row ['gateway']; ?>" />
                                        <br/>Broadcast<br/><input type="text" name="broadcast" value="<?php echo $row ['broadcast']; ?>" />
                                        <br/>DNS Nameserver<br/><input type="text" name="nameserver" value="<?php echo $row ['nameserver']; ?>" />
                                        <br/>DNS Domain<br/><input type="text" name="domain" value="<?php echo $row ['domain']; ?>" />
                                        <br/>DNS Search<br/><input type="text" name="search" value="<?php echo $row ['search']; ?>" />
                                        <br/><br/>
                                        <input type="submit" value="Submit">
                                    </form>
                                </div>
                            </div><br/>
                    </div>
                    <div id="t2" class="w3-hide">
                        <br/>

                        <hr/>

                        <br/>

                    </div>
                    <div id="t3" class="w3-hide">
                        <br/>
                        <div class="w3-row">
                            <div class="w3-col w3-container m3 s6">
                                <div class="w3-card w3-white">
                                    <h4 class="w3-container w3-center"><span data-bind="text: 'CPU Temperature is '+status.tCPU()+'&deg;C'"></span></h4>
                                    <div class="w3-container">
                                        <div class="w3-light-gray">
                                            <div class="w3-blue" data-bind=" style:{height: '12px', width: calcP(status.tCPU(),0,100)+ '%'}">&nbsp;</div>
                                        </div>
                                    </div>
                                    <br/>
                                </div>
                                <br/>
                            </div>
                            <div class="w3-col w3-container m3 s6">
                                <div class="w3-card w3-white">
                                    <h4 class="w3-container w3-center"><span data-bind="text: 'CPU Load is '+status.tCPU()+'&deg;C'"></span></h4>
                                    <div class="w3-container">
                                        <div class="w3-light-gray">
                                            <div class="w3-blue" data-bind=" style:{height: '12px', width: calcP(status.tCPU(),0,100)+ '%'}">&nbsp;</div>
                                        </div>
                                    </div>
                                    <br/>
                                </div>
                                <br/>
                            </div>
                            <div class="w3-col w3-container m3 s6">
                                <div class="w3-card w3-white">
                                    <h4 class="w3-container w3-center"><span data-bind="text: 'IP Address is: '+status.tCPU()"></span></h4>
                                    <br/>
                                </div>
                                <br/>
                            </div>
                        </div>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------------------------------------- FOOTER ------------------------------------------------------------------------------------------------------------>
        <div class="w3-bottom w3-light-gray " style="max-width:1024px;min-width:350px">
            <div class="w3-bar w3-center">
                <snap data-bind="text: status.showTime()">time</snap>
                <snap data-bind="text: status.showDate()">date</snap>
            </div>
            <div class="w3-bar w3-center">
                <h4><span class="w3-text-gray">Eagle</span><span class="w3-text-orange">MON</span></h4>
            </div>
        </div>
    </div>
</body>
<script src="lib.js " type="text/javascript"></script>
<script src="config.js " type="text/javascript"></script>
<script type="text/javascript">
    function R0Menu() {
        var x = document.getElementById("t0");
        if (x.className.indexOf("w3-show") == -1) {
            x.className = " w3-show";
            document.getElementById("b0").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-left w3-border-top";
            document.getElementById("b1").className = "w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-top w3-border-bottom";
            document.getElementById("b2").className = "w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-top w3-border-bottom";
            document.getElementById("b3").className = "w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-top w3-border-bottom";
            document.getElementById("t1").className = "w3-hide";
            document.getElementById("t2").className = "w3-hide";
            document.getElementById("t3").className = "w3-hide";
        }
    }

    function R1Menu() {
        var x = document.getElementById("t1");
        if (x.className.indexOf("w3-show") == -1) {
            x.className = " w3-show";
            document.getElementById("b0").className = "w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-left w3-border-top w3-border-bottom";
            document.getElementById("b1").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top";
            document.getElementById("b2").className = "w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-top w3-border-bottom";
            document.getElementById("b3").className = "w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-top w3-border-bottom";
            document.getElementById("t0").className = "w3-hide";
            document.getElementById("t2").className = "w3-hide";
            document.getElementById("t3").className = "w3-hide";
        }
    }

    function R2Menu() {
        var x = document.getElementById("t2");
        if (x.className.indexOf("w3-show") == -1) {
            x.className = " w3-show";
            document.getElementById("b0").className = "w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-left w3-border-top w3-border-bottom";
            document.getElementById("b1").className = "w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-top w3-border-bottom";
            document.getElementById("b2").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top";
            document.getElementById("b3").className = "w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-top w3-border-bottom";
            document.getElementById("t0").className = "w3-hide";
            document.getElementById("t1").className = "w3-hide";
            document.getElementById("t3").className = "w3-hide";
        }
    }

    function R3Menu() {
        var x = document.getElementById("t3");
        if (x.className.indexOf("w3-show") == -1) {
            x.className = " w3-show";
            document.getElementById("b0").className = "w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-left w3-border-top w3-border-bottom";
            document.getElementById("b1").className = "w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-top w3-border-bottom";
            document.getElementById("b2").className = "w3-button w3-block w3-gray w3-text-white w3-border-right w3-border-top w3-border-bottom";
            document.getElementById("b3").className = "w3-button w3-block w3-light-gray w3-border-right w3-border-top";
            document.getElementById("t0").className = "w3-hide";
            document.getElementById("t1").className = "w3-hide";
            document.getElementById("t2").className = "w3-hide";
        }
    }

</script>

</html>
