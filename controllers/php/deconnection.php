<?php
$_SESSION = array();
setcookie('auth', '', -3600);
session_destroy();
header('Location: index.php');
 ?>