<?php


require_once 'localstorage/modules/login.php';
require_once 'localstorage/modules/basic.php';

$user = check_user();
if ($user) {
    include 'localstorage/'.$_SESSION['page'];
} else {
    #echo "bad user";
}


//$aba = $_SESSION['page'];
//echo "<script>alert('".$aba."')</script>";
?>
