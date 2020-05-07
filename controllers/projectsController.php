<?php

require_once("Controller.php");

class ProjectsController extends Controller{

    public function __construct(){
        $this->loadModel("Projects");
    }

    public function projects($page = 1){
        $perPage = 4;
        $nbProjects = $this->Projects->getProjectsNumber();
        $nbPage = ceil($nbProjects/$perPage);
    
        $page = !($page>0 && $page<=$nbPage) ? 1 : $page;
    
        $projects = $this->Projects->getProjects($page, $perPage);
        $title = "Projets·JE";
        
        $this->setVariables(compact("title", "projects", "nbPage", "page"));
        $this->render("projects", "projects");
    } 

    public function project(int $project_id){
        $project_id = (int)$project_id;
        $project = $this->Projects->getProject($project_id);
    
        $_SESSION['loadCommentsProjectId'] = $project_id;
        $title = $project['title'];

        $this->setVariables(compact("title", "tags", "project"));
        $this->render("projects", "project");
    } 

    public function newProject(){
        $this->setVariables("title", "Créer un projet·JE");
        $this->render("projects", "newProject");
    }
    
    public function createProject(){
        extract($_POST);
    
        $project_title = htmlspecialchars(strip_tags($project_title));
        $project_content = htmlspecialchars(strip_tags($project_content));
        $summary = htmlspecialchars(strip_tags($summary));
        if (!empty($project_title) && !empty($project_content) && !empty($summary)) {
            if(strlen($project_title)<250){
                if(strlen($project_content) > strlen($summary)){
                    $project_exist = $this->Projects->titleTest($project_title);
                    if (!$project_exist) {
                        //TODO:Ne permettre que certains tags, avec une liste en bdd et une barre de recherche;
                        $this->Projects->createProject($project_title, $_SESSION['ID'], $project_content, $summary, $tags);
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
            $msg = 'Tous les champs doivent être complétés';
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
    
    
    public function editProject(int $project_id){
    
        $project = $this->Projects->getProject($project_id, false);
        // TODO:Changer les <br /> en retour à la ligne
    
        $title = "Edition du projet·JE";
        
        $this->setVariables(compact("title", "project"));
        $this->render("projects", "editProject");
    }
    
    public function setProject(){
        $_SESSION["error"] = "";
        extract($_POST);
    
        $project_info = $this->Projects->getProject($id);
    
        if(isset($newtitle) && !empty($newtitle) && $newtitle != $project_info['title']){
        $titre_exist = $this->Projects->titleTest($newtitle);
        if (!$titre_exist) {
            $this->Projects->setProject((int)$id, "title", $newtitle);
        }else{
            $msg = 'Ce titre est déjà utilisé';
        }
        }
    
        if(isset($newcontent) && !empty($newcontent) && $newcontent != $project_info['content']){
            $this->Projects->setProject($id, "content", $newcontent);
        }
        
        if(isset($newsummary) && !empty($newsummary) && $newsummary != $project_info['summary']){
            if (strlen($newsummary) < 500) {
                $this->Projects->setProject($id, "summary", $newsummary);
            }else{
            $msg = 'Le résumé est trop long.';
            }
        }
    
        if(isset($newtags) && !empty($newtags) && $newtags != $project_info['tags']){
            $this->Projects->setProject($id, "tags", $newtags);
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
    
    public function deleteProject(int $project_id){
    
        $this->Projects->deleteProject($project_id);
        if(isset($_SERVER['HTTP_REFERER'])){
            header("Location: ".$_SERVER['HTTP_REFERER']);
        }else{
            header('Location: /index.php');
        }
    }
}






//TODO vider sessionproject info
