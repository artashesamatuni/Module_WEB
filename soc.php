
<?php
$host= gethostname();
$ip = gethostbyname($host);
$server_ip = gethostbyname($_SERVER['SERVER_NAME']);
echo $host;
echo "<br/>";
echo $ip;
echo "<br/>";
echo $server_ip;
echo "<br/>";

// create a new cURL resource
$ch = curl_init ();

// set URL and other appropriate options
curl_setopt ($ch, CURLOPT_URL, "http://ipecho.net/plain");
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

// grab URL and pass it to the browser

$pubip = curl_exec ($ch);
curl_close ($ch);

echo $pubip;
?>
