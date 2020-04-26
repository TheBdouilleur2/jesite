<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/ProjectsManager.php');


$ProjectsManager = new ProjectsManager();

$lastProjects = $ProjectsManager->getProjects(1, 3);


require_once('views/indexView.php');
?>
