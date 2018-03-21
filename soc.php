
<?php


$fp = fsockopen(gethostbyname($host), 85, $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    fwrite($fp, "You message");
    fclose($fp);
}

?>
