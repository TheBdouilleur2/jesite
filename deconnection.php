<?php
session_start();
$_SESSION = array();
setcookie('pseudo', '', -3600);
setcookie('mdp', '', -3600);
session_destroy();
header('Location: index.php');
 ?>
