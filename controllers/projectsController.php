<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/models/ProjectsManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/php/Parsedown.php");

$ProjectsManager = new ProjectsManager();
$Parsedown = new Parsedown();

function displayProjects($page = 1){
    global $ProjectsManager, $Parsedown;
    $perPage = 4;
    $nbProjects = $ProjectsManager->getProjectsNumber();
    $nbPage = ceil($nbProjects/$perPage);

    $page = !($page>0 && $page<=$nbPage) ? 1 : $page;

    $projects = $ProjectsManager->getProjects($page, $perPage);

    $title = "Projets·JE";

    include_once("views/projects/projectsView.php");
} 

function displayProject( $project_id){
    global $ProjectsManager, $Parsedown;
    $project_id = (int)$project_id;
    $project = $ProjectsManager->getProject($project_id);

    $content = $Parsedown->text($project['content']);

    $tags = explode("/", $project['tags']);

    $title = $project['title'];
    include_once("views/projects/projectView.php");
} 

function newProject(){

    $title = 'Créer un projet·JE';
    include_once(ROOT . "/views/projects/newprojectView.php");
}


function editProject(int $id){
    global $ProjectsManager;

    $project = $ProjectsManager->getProject($id);
    // TODO:Changer les <br /> en retour à la ligne

    $title = "Edition du projet·JE";
    include_once(ROOT . "/views/projects/editProject.php");
}

function deleteProject(int $id){
    global $ProjectsManager;

    $ProjectsManager->deleteProject($id);
    if(isset($_SERVER['HTTP_REFERER'])){
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }else{
        header('Location: ../index.php');
    }
}