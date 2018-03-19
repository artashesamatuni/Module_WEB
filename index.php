<?php


require_once 'localstorage/modules/login.php';
require_once 'localstorage/modules/basic.php';

$user = check_user();
if($user=='admin')
{
    include 'localstorage/main.php';
}
else {
    #echo "bad user";
}






?>
