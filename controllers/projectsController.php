<?php

require('models/ProjectsManager.php');
$projectsManager = new ProjectsManager();

function displayProjects(){
    $projects = $projectsManager->getProjects();
    require("views/projectsView.php");
} 