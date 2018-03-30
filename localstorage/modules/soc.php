<?php
function send($msg)
{
    $fp = fsockopen("127.0.0.1", 4927, $errno, $errstr, 30);
    if (!$fp) {
        echo "$errstr ($errno)<br/>\n";
    } else {
        fwrite($fp, $msg);
        fclose($fp);
    }
}


function get($msg)
{
    $fp = fsockopen("127.0.0.1", 4927, $errno, $errstr, 30);
    if (!$fp) {
        echo "$errstr ($errno)<br/>\n";
        return Null;
    } else {
        fwrite($fp, $msg);
        $contents = fread($fp, 1024);
        fclose($fp);
        return $contents;
    }
}

?>
