<?php
session_start();

$success = 0;
$msg = "Une erreur est survenue (script.php)";

require_once($_SERVER['DOCUMENT_ROOT'] . '/models/ProjectsManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/php/Parsedown.php');

$ProjectManager = new ProjectsManager();
$Parsedown = new Parsedown();

extract($_POST);

$project_title = htmlspecialchars(strip_tags($project_title));
$project_content = htmlspecialchars(strip_tags($project_content));
$summary = htmlspecialchars(strip_tags($summary));
if (!empty($project_title) && !empty($project_content) && !empty($summary)) {
    if(strlen($project_title)<250){
        if(strlen($project_content) > strlen($summary)){
            $project_exist = $ProjectManager->titleTest($project_title);
            if (!$project_exist) {
                //TODO:Ne permettre que certains tags, avec une liste en bdd et une barre de recherche;
                $ProjectManager->createProject($project_title, $_SESSION['ID'], $project_content, $summary, $tags);
                $_SESSION['msg'] = 'Votre project <strong>'.$project_title.'</strong> a bien été créé';
                $success = 1;
            }else{
                $msg = 'Le titre que vous avez choisi est déjà utilisé. Veuillez en choisir un autre.';
            }
        }else {
            $msg = 'Le résumé est plus long que le contenu.';
        }
    }else{
    $msg = 'Le titre est trop long, il ne doit pas exéder 250 caractères.';
    }
}else{
    $msg = 'Tout les champs doivent être remplis';
}


echo json_encode(compact("success", 'msg'));