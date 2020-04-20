<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/ProjectsManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/php/Parsedown.php');


$ProjectsManager = new ProjectsManager();

$lastProjects = $ProjectsManager->getProjects(1, 3);

$Parsedown = new Parsedown();

require_once('views/indexView.php');
?>
