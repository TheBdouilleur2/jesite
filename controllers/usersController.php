<?php
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {

	require_once($_SERVER['DOCUMENT_ROOT'] . '/models/UsersManager.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/models/ProjectsManager.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/php/functions.php');
	require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/php/Parsedown.php');

	$UserManager = new UsersManager();
	$ProjectsManager = new ProjectsManager();
	$Parsedown = new Parsedown();

	function sign_up(){
		require_once('views/users/sign_upView.php');
	}
	function sign_in(){
		require_once('views/users/sign_inView.php');
	}

	function account(){
		$title = "Profil·JE";

		require_once($_SERVER['DOCUMENT_ROOT'] . '/views/users/account.php');
	}

	/**
	 * Affiche la page de profil d'un utilisateur
	 * @param int $id ID de l'utilisateur dont on veut afficher le profil
	 */
	function profile(int $id){
		global $UserManager, $Parsedown, $ProjectsManager;
		$user_info = $UserManager->getUserByID((int)$id);
		$user_info['age'] = getOld($user_info['login_date']);
		$user_info['bio'] = $Parsedown->line($user_info['bio']);
		$user_info['projects'] = $ProjectsManager->getProjectsByUser($id); 
		$user_info['skills'] = explode("/", $user_info['skills']);

		$title = "Profil·JE de " . $user_info['username'];

		require_once($_SERVER['DOCUMENT_ROOT'] . '/views/users/showProfile.php');
	}

}else{
	if(isset($_SERVER['HTTP_REFERER'])){
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}else{
		header('Location: index.php');
	}
}