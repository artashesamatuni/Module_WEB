<?php

	$submask = exec("ifconfig eth0 | grep inet", $out);
    $submask = str_ireplace("inet addr:", "", $submask);
    $submask = str_ireplace("Mask:", "", $submask);
    $submask = trim($submask);
    $submask = explode(" ", $submask);
	$ip_adress=$submask[0];
	$mask=$submask[4];

	$gatewayType = shell_exec("route -n");
	$gatewayTypeRaw = explode(" ", $gatewayType);
	$gateway=$gatewayTypeRaw[42];

	$dnsType = file('/etc/resolv.conf');
	$dnsType = str_ireplace("nameserver ", "", $dnsType);
	$dns1 = $dnsType[2];
	$dns2 = $dnsType[3];
	$dns3 = $dnsType[4];

	$hostname = GETHOSTNAME();
    echo $ip_adress;
    echo "<br/>";
    echo $dns3;
    echo "<br/>";
    echo $gateway;
    echo "<br/>";
?>
