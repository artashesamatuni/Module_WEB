<?php
require_once 'basic.php';
$_SESSION['page'] = htmlspecialchars($_GET['link']);
alert("aaaaaa");
header('Location: ' . $_SERVER['HTTP_REFERER']);
 ?>
