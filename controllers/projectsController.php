<?php

require('models/ProjectsManager.php');
$projectsManager = new ProjectsManager();

function displayProjects(){
    $projects = $projectsManager->getProjects();
    require("views/projectsView.php");
} 

function displayProject( $project_id){
    $project_id = (int)$project_id;
    $project = $projectsManager->getProject($project_id);
    include('Parsedown.php');
    $Parsedown = new Parsedown();
    $Parsedown->setSafeMode(true);
    $content = $Parsedown->text($project['content']);
    $tags = explode($project['tags'], "/");
    require("views/projectView.php");
} 