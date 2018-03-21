<?php
    $fp = fsockopen("127.0.0.1", 4927, $errno, $errstr, 30);
    if (!$fp) {
        echo "$errstr ($errno)<br />\n";
    } else {
        if (isset($_POST['do1'])) {
            fwrite($fp, "btn1");
        }
        if (isset($_POST['do2'])) {
            fwrite($fp, "btn2");
        }
        if (isset($_POST['do3'])) {
            fwrite($fp, "btn3");
        }
        if (isset($_POST['do4'])) {
            fwrite($fp, "btn4");
        }
        fclose($fp);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>
