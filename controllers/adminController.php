<?php
if (!isset($_SESSION['id']) && empty($_SESSION['id']) && $_SESSION['state'] === 'admin') {

    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/UsersManager.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/ProjectsManager.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/php/Parsedown.php');

    $UsersManager = new UsersManager();
    $ProjectsManager = new ProjectsManager();
    $Parsedown = new Parsedown();
    
    function index(){
        global $UsersManager, $ProjectsManager, $Parsedown;
        $title = 'Espace Admin·JE';
        $users = $UsersManager->getUsers(0);
        $projects = $ProjectsManager->getProjects();

        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/admin/index.php');
    }

}else{
    header("Location: index.php");
}