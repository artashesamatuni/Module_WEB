<?php
include 'localstorage/dashboard_main.php';
/*
if (!isset($_SESSION['started'])) {
    session_start();
    $_SESSION['started'] = 1;
    $_SESSION['timeout'] = time();
}

if (isset($_SESSION['started'])) {

    if (!isset($_SESSION['page'])) {
        $_SESSION['page'] = "modules/dashboard/dashboard_main.php";
    }

    if (isset($_SESSION['user'])) {
        include 'localstorage/modules/dashboard/dashboard_main.php';
    } else {
        require_once 'localstorage/modules/login.php';
        $_SESSION['user'] = check_user();
    }

    //    if ($a=check_user()) {

    //    } else {
    //        $_SESSION['page']='';
          //  snackbar("Wrong User!");
    //    }

}
*/
?>
