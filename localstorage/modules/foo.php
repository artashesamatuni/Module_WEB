<?php
$_SESSION['page'] = "\"".htmlspecialchars($_GET['link'])."\"";
echo $_SESSION['page'];

//header('Location: ' . $_SERVER['HTTP_REFERER']);
 ?>
