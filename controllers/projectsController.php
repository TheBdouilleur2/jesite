<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/models/ProjectsManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/php/Parsedown.php");

$projectsManager = new ProjectsManager();
$Parsedown = new Parsedown();

function displayProjects(){
    global $projectsManager, $Parsedown;
    $projects = $projectsManager->getProjects();

    $title = "Projets·JE";

    include_once("views/projects/projectsView.php");
} 

function displayProject( $project_id){
    global $projectsManager, $Parsedown;
    $project_id = (int)$project_id;
    $project = $projectsManager->getProject($project_id);

    $content = $Parsedown->text($project['content']);

    $tags = explode("/", $project['tags']);

    $title = $project['title'];
    include_once("views/projects/projectView.php");
} 

function newProject(){
    global $projectsManager;

    $title = 'Créer un projet·JE';
    include_once(ROOT . "/views/projects/newprojectView.php");
}


function editProject(int $id){
    global $projectsManager;

    $project = $projectsManager->getProject($id);
    // TODO:Changer les <br /> en retour à la ligne

    $title = "Edition du projet·JE";
    include_once(ROOT . "/views/projects/editProject.php");
}

function deleteProject(int $id){
    global $projectsManager;

    $projectsManager->deleteProject($id);
    if(isset($_SERVER['HTTP_REFERER'])){
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }else{
        header('Location: ../index.php');
    }
}