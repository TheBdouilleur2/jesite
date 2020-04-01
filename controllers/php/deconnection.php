<?php
session_start();
$_SESSION = array();
setcookie('username', '', -3600);
setcookie('passwd', '', -3600);
session_destroy();
header('Location: index.php');
 ?>