<?php


require 'localstorage/modules/login.php';
require 'localstorage/modules/basic.php';

if(check_user())
{
    include 'localstorage/main.php';
}






?>
