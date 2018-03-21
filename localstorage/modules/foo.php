<?php
$_SESSION['page'] = "aaa";//htmlspecialchars($_GET['something']);
header('Location: ' . $_SERVER['HTTP_REFERER']);
 ?>
