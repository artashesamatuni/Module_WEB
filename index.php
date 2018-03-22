<?php
if (!isset($_SESSION['started']))
{
    session_start();
    $_SESSION['started']=1;
    $_SESSION['timeout'] = time();
}

if (isset($_SESSION['started']))
{
    if (!isset($_SESSION['page']))
        {
            $_SESSION['page'] = "modules/dashboard/dashboard_main.php";
        }
        require_once 'localstorage/modules/login.php';
        require_once 'localstorage/modules/basic.php';
        if ($a=check_user()) {
            snackbar($a);
            include 'localstorage/modules/dashboard/dashboard_main.php';
            //select($_SESSION['page']);
        } else {
            $_SESSION['page']='';
            session_destroy();
            snackbar("Wrong User!");
        }

}

?>
