<?php 
session_start();

define("WEBROOT", dirname(__FILE__));
define("ROOT", WEBROOT);
define("Base_URL", dirname(dirname($_SERVER['SCRIPT_NAME'])));
define("DS", DIRECTORY_SEPARATOR);
define("CORE", ROOT.DS."core");

require_once(ROOT.DS."models".DS."UsersManager.php");
$UsersManager = new UsersManager;
$UsersManager->connectUser();



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
		$UsersControllers = new UsersController;
		$UsersControllers->sign_up();
	}elseif($url[0]==='sign_in'){
		require_once('controllers/usersController.php');
		$UsersControllers = new UsersController;
		$UsersControllers->sign_in();
	}elseif($url[0]==='create_user'){
		require_once('controllers/usersController.php');
		$UsersControllers = new UsersController;
		$UsersControllers->create_user();
	}elseif($url[0]==='connect_user'){
		require_once('controllers/usersController.php');
		$UsersControllers = new UsersController;
		$UsersControllers->connect_user();
	}elseif($url[0] === 'account'){
		require_once('controllers/usersController.php');
		$UsersControllers = new UsersController;
		$UsersControllers->account();
	}elseif($url[0] === 'profile' && isset($url[1])){
		require_once('controllers/usersController.php');
		$UsersControllers = new UsersController;
		$UsersControllers->profile((int)$url[1]);
	}elseif($url[0]==='deconnection'){
		require_once('controllers/php/deconnection.php');
	}
	//	Projets:
	elseif($url[0]==='projects'){
		require_once('controllers/projectsController.php');
		$ProjectsController = new ProjectsController;
		if(isset($url[1])){
			$page = (int)$url[1];
		}else{
			$page = 1;
		}
		$ProjectsController->projects($page);
	}elseif($url[0]==='my_projects'){
		require_once('controllers/projectsController.php');
		$ProjectsController = new ProjectsController;
		if(isset($url[1])){
			$page = (int)$url[1];
		}else{
			$page = 1;
		}
		$ProjectsController->my_projects($page);
	}elseif($url[0]==='project' && isset($url[1])){
        $project_id = (int)$url[1];
		require_once('controllers/projectsController.php');
		$ProjectsController = new ProjectsController;
		$ProjectsController->project($project_id);
	}elseif($url[0]==='new_project'){
		require_once('controllers/projectsController.php');
		$ProjectsController = new ProjectsController;
		$ProjectsController->newProject();
	}elseif($url[0]==='create_project'){
		require_once('controllers/projectsController.php');
		$ProjectsController = new ProjectsController;
		$ProjectsController->createProject();
	}elseif ($url[0] === 'delete_project' && isset($url[1])) {
		require_once("controllers/projectsController.php");
		$ProjectsController = new ProjectsController;
		$id = (int)$url[1];
		$ProjectsController->deleteProject($id);
	}elseif ($url[0] === 'edit_project' && isset($url[1])) {
		require_once("controllers/projectsController.php");
		$ProjectsController = new ProjectsController;
		$id = (int)$url[1];
		$ProjectsController->editProject($id);
	}elseif($url[0]==='set_project'){
		require_once('controllers/projectsController.php');
		$ProjectsController = new ProjectsController;
		$ProjectsController->setProject();
	}
	//	Chat:
	elseif($url[0]==='chat'){
		require_once('controllers/chatController.php');
		$ChatController = new ChatController;
		if(isset($url[1])){
			$page = (int)$url[1];
		}else{
			$page = 1;
		}
		$ChatController->displayUsersMessages($page);
	}
	//	Admin:
	elseif($url[0] === 'admin'){
		if(isset($url[1])){
			if($url[1]==="chat"){
				require_once("controllers/adminController.php");
				$AdminController = new AdminController;
				if(isset($url[2])){
					$page = (int)$url[2];
				}else{
					$page = 1;
				}
				$AdminController->chat($page);
			}elseif($url[1]==="projects"){
				require_once("controllers/adminController.php");
				$AdminControler = new AdminController;
				$AdminControler->projects();
			}
		}else{
			require_once("controllers/adminController.php");
			$AdminControler = new AdminController;
			$AdminControler->index();
		}
	}
	else{
		require_once('controllers/Controller.php');
		$Controller = new Controller;
		$Controller->e404();

	}
} catch (Exception $e) {
	echo 'Erreur '.$e->getMessage();
}
