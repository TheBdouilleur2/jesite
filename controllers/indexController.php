<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/UsersManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/ProjectsManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/php/Parsedown.php');

$userManager = new UsersManager();
$userManager->connectUser();

$ProjectsManager = new ProjectsManager();

$lastProjects = $ProjectsManager->getProjects(1, 3);

$Parsedown = new Parsedown();

require_once('views/indexView.php');
?>
