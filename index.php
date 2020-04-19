<?php 
session_start();

require_once('conf.php');

$url = '';
try {
	if (isset($_GET['url'])) {
		$url = explode('/', $_GET['url']);
	}
	if ($url == '') {
		require_once('controllers/indexController.php');
	}
	// Users:
	elseif($url[0]==='sign_up'){
		require_once('controllers/usersController.php');
		sign_up();
	}elseif($url[0]==='sign_in'){
		require_once('controllers/usersController.php');
		sign_in();
	}elseif($url[0] === 'profile'){
		require_once("controllers/usersController.php");
		profile();
	}elseif($url[0]==='deconnection'){
		require_once('controllers/php/deconnection.php');
	}
	//	Projets:
	elseif($url[0]==='projects'){
		require_once('controllers/projectsController.php');
		if(isset($url[1])){
			$page = (int)$url[1];
		}else{
			$page = 1;
		}
		displayProjects($page);
	}elseif($url[0]==='project' && isset($url[1])){
        $project_id = (int)$url[1];
		require_once('controllers/projectsController.php');
		displayProject($project_id);
	}elseif($url[0]==='new_project'){
		require_once('controllers/projectsController.php');
		newProject();
	}elseif ($url[0] === 'delete_project' && isset($url[1])) {
		require_once("controllers/projectsController.php");
		$id = (int)$url[1];
		deleteProject($id);
	}elseif ($url[0] === 'edit_project' && isset($url[1])) {
		require_once("controllers/projectsController.php");
		$id = (int)$url[1];
		editProject($id);
	}
	//	Chat:
	elseif($url[0]==='chat'){
		require_once('controllers/chatController.php');
		if(isset($url[1])){
			$page = (int)$url[1];
		}else{
			$page = 1;
		}
		displayUsersMessages($page);
	}elseif ($url[0] === 'chat_admin') {
		require_once("controllers/chatController.php");
		if(isset($url[1])){
			$page = (int)$url[1];
		}else{
			$page = 1;
		}
		displayAdminMessages($page);
	}
	//	Admin:
	elseif($url[0] === 'admin_space'){
		require_once("controllers/adminController.php");
		index();
	}
	else{
		require_once('views/error404.php');
	}
} catch (Exception $e) {
	echo 'Erreur '.$e->getMessage();
}
