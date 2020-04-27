<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/models/ProjectsManager.php');

$ProjectsManager = new ProjectsManager();

function displayProjects($page = 1){
    global $ProjectsManager;
    $perPage = 4;
    $nbProjects = $ProjectsManager->getProjectsNumber();
    $nbPage = ceil($nbProjects/$perPage);

    $page = !($page>0 && $page<=$nbPage) ? 1 : $page;

    $projects = $ProjectsManager->getProjects($page, $perPage);

    $title = "Projets·JE";

    include_once("views/projects/projectsView.php");
} 

function displayProject($project_id){
    global $ProjectsManager;
    $project_id = (int)$project_id;
    $project = $ProjectsManager->getProject($project_id);


    $tags = explode("/", $project['tags']);

    $title = $project['title'];
    include_once("views/projects/projectView.php");
} 

function newProject(){

    $title = 'Créer un projet·JE';
    include_once(ROOT . "/views/projects/newprojectView.php");
}

function createProject(){
    global $ProjectsManager;
    extract($_POST);

    $project_title = htmlspecialchars(strip_tags($project_title));
    $project_content = htmlspecialchars(strip_tags($project_content));
    $summary = htmlspecialchars(strip_tags($summary));
    if (!empty($project_title) && !empty($project_content) && !empty($summary)) {
        if(strlen($project_title)<250){
            if(strlen($project_content) > strlen($summary)){
                $project_exist = $ProjectsManager->titleTest($project_title);
                if (!$project_exist) {
                    //TODO:Ne permettre que certains tags, avec une liste en bdd et une barre de recherche;
                    $ProjectsManager->createProject($project_title, $_SESSION['ID'], $project_content, $summary, $tags);
                    $_SESSION['msg'] = 'Votre project <strong>'.$project_title.'</strong> a bien été créé';
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
    if(!empty($msg)){
        $_SESSION['error'] = $msg;
        $_SESSION['project_info'] = $_POST;
        header("Location: new_project");
    }else{
        $_SESSION['error'] = "";
        header("Location: projects");
    }
}


function editProject(int $project_id){
    global $ProjectsManager;

    $project = $ProjectsManager->getProject($project_id, false);
    // TODO:Changer les <br /> en retour à la ligne

    $title = "Edition du projet·JE";
    include_once(ROOT . "/views/projects/editProject.php");
}

function setProject(){
    global $ProjectsManager;
    $_SESSION["error"] = "";
    extract($_POST);

    $project_info = $ProjectsManager->getProject($id);

    if(isset($newtitle) && !empty($newtitle) && $newtitle != $project_info['title']){
    $titre_exist = $ProjectsManager->titleTest($newtitle);
    if (!$titre_exist) {
        $ProjectsManager->setProject((int)$id, "title", $newtitle);
    }else{
        $msg = 'Ce titre est déjà utilisé';
    }
    }

    if(isset($newcontent) && !empty($newcontent) && $newcontent != $project_info['content']){
        $ProjectsManager->setProject($id, "content", $newcontent);
    }
    
    if(isset($newsummary) && !empty($newsummary) && $newsummary != $project_info['summary']){
        if (strlen($newsummary) < 500) {
            $ProjectsManager->setProject($id, "summary", $newsummary);
        }else{
        $msg = 'Le résumé est trop long.';
        }
    }

    if(isset($newtags) && !empty($newtags) && $newtags != $project_info['tags']){
        $ProjectsManager->setProject($id, "tags", $newtags);
    }

    if(!empty($msg)){
        $_SESSION['error'] = $msg;
        $_SESSION['project_info'] = $_POST;
        header("Location: edit_project/".$id);
    }else{
        $_SESSION['error'] = "";
        header("Location: project/".$id);
    }
}

function deleteProject(int $project_id){
    global $ProjectsManager;

    $ProjectsManager->deleteProject($project_id);
    if(isset($_SERVER['HTTP_REFERER'])){
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }else{
        header('Location: /index.php');
    }
}
//TODO vider sessionproject info