<?php

require($_SERVER['DOCUMENT_ROOT'] . '/models/ProjectsManager.php');
$projectsManager = new ProjectsManager();

function displayProjects(){
    $projects = $projectsManager->getProjects();
    require("views/projects/projectsView.php");
} 

function displayProject( $project_id){
    $project_id = (int)$project_id;
    $project = $projectsManager->getProject($project_id);
    include('Parsedown.php');
    $Parsedown = new Parsedown();
    $Parsedown->setSafeMode(true);
    $content = $Parsedown->text($project['content']);
    $tags = explode($project['tags'], "/");
    require("views/projects/projectView.php");
} 