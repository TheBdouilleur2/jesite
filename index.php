<<<<<<< HEAD
<?php 
session_start();
$url = '';
try {
	if (isset($_GET['url'])) {
		$url = explode('/', $_GET['url']);
	}
	if ($url == '') {
		require('controllers/indexController.php');
	}elseif($url[0]==='sign_up'){
		require('controllers/usersController.php');
		sign_up();
	}elseif($url[0]==='sign_in'){
		require('controllers/usersController.php');
		sign_in();
	}elseif($url[0] === 'profile'){
		require_once("controllers/usersController.php");
		profile();
	}elseif($url[0]==='deconnection'){
		require('controllers/php/deconnection.php');
	}/* elseif($url[0]==='projects'){
		require('controllers/projectsController.php');
		displayProjects();
	}elseif($url[0]==='project' && isset($url[1])){
        $project_id = (int)$url[1];
		require('controllers/projectsController.php');
		displayProject($project_id);
	}elseif($url[0]==='new_project'){
		require('controllers/projectsController.php');
		createProject();
	} */elseif($url[0]==='chat'){
		require('controllers/chatController.php');
		displayUsersMessages();
	}elseif ($url[0] === 'chat_admin') {
		require_once("controllers/chatController.php");
		displayAdminMessages();
	}elseif($url[0] === 'admin_space'){
		require_once("controllers/adminController.php");
		index();
	}
	else{
		require('views/error404.php');
	}
} catch (Exception $e) {
	echo 'Erreur '.$e->getMessage();
}
=======
<?php
/*
* @todo tesst du todo
* @body Test du todo
*/
session_start();
include_once('cookie_connect.php');
try {new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
	die('Erreur : '.$e->getMessage());
}
// TODO: ne pas augmenter
$compteur = fopen("fichiers/compteuraccueil.txt", 'r+');
$nbvue = fgets($compteur);
$nbvue += 1;
fseek($compteur, 0);
fputs($compteur, $nbvue);
fclose($compteur);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>J-E site</title>
	<link rel="stylesheet" href="style/style.css">
	<link rel='shortcut icon' href="Images/Pythonsign.ico">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
</head>
<body>

	<?php
	include("header.php");
	?>
<section>
	<?php
	if (isset($_SESSION['msg'])) {
		echo '<p>'.$_SESSION['msg'].'</p>';
	}?>

</section>
</body>
</html>
>>>>>>> master
