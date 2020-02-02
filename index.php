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
	}elseif($url[0]==='deconnection'){
		require('controllers/php/deconnection.php');
	}elseif($url[0]==='projects'){
		require('controllers/projectsController.php');
		displayProjects();
	}elseif($url[0]==='project' && isset($url[1])){
        $project_id = (int)$url[1];
		require('controllers/projectsController.php');
		displayProject($project_id);
	}
	else{
		require('views/error404.php');
	}
} catch (Exception $e) {
	echo 'Erreur '.$e->getMessage();
}
