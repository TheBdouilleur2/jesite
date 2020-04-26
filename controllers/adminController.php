<?php
if (!isset($_SESSION['id']) && empty($_SESSION['id']) && $_SESSION['state'] === 'admin') {

    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/UsersManager.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/models/ProjectsManager.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/php/Parsedown.php');

    $UsersManager = new UsersManager();
    $ProjectsManager = new ProjectsManager();
    $Parsedown = new Parsedown();
    
    function index(){
        global $UsersManager, $Parsedown;
        $title = 'Espace Admin·JE';
        $users = $UsersManager->getUsers();
        

        require_once(ROOT.DS."views".DS."admin".DS."index.php");
    }

    function projects(){
        global $ProjectsManager, $Parsedown;
        $title = 'Espace Admin Projets·JE';

        $nbProjects = $ProjectsManager->getProjectsNumber();
        $projects = $ProjectsManager->getProjects(1, $nbProjects);

        require_once(ROOT.DS."views".DS."admin".DS."projects.php");
    }

}else{
    header("Location: index.php");
}