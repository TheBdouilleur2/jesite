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
        $this->render("projects");
    }

    public function my_projects($page = 1){
        $perPage = 4;
        $nbProjects = $this->Projects->getProjectsNumberByUser($_SESSION['ID']);
        $nbPage = ceil($nbProjects/$perPage);
    
        $page = !($page>0 && $page<=$nbPage) ? 1 : $page;
    
        $projects = $this->Projects->getProjectsByUser($_SESSION['ID'], $page, $perPage, false);
        $title = "Mes projets·JE";
        
        $this->setVariables(compact("title", "projects", "nbPage", "page"));
        $this->render("my_projects");
    } 

    public function project(int $project_id){
        $project_id = (int)$project_id;
        $project = $this->Projects->getProject($project_id);
    
        $_SESSION['loadCommentsProjectId'] = $project_id;
        $title = $project['title'];

        $this->setVariables(compact("title", "project"));
        $this->render("project");
    } 

    public function newProject(){
        $this->setVariables("title", "Créer un projet·JE");
        $this->render("newProject");
    }
    
    public function createProject(){
        extract($_POST);
    
        $project_title = htmlspecialchars($project_title);
        $project_content = htmlspecialchars($project_content);
        $summary = htmlspecialchars($summary);
        if (!empty($project_title) && !empty($project_content) && !empty($summary)) {
            if(strlen($project_title)<250){
                if(strlen($project_content) > strlen($summary)){
                    $project_exist = $this->Projects->titleTest($project_title);
                    $online = 0;
                    if(isset($online)){
                        $online = 1;
                    }
                    if (!$project_exist) {
                        //TODO:Ne permettre que certains tags, avec une liste en bdd et une barre de recherche;
                        $this->Projects->createProject($project_title, $_SESSION['ID'], $project_content, $summary, $tags, (int)$online);
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

        $project['content'] = str_replace("&lt;br /&gt;", "",  $project['content']);
        $project['summary'] = str_replace("&lt;br /&gt;", "",  $project['summary']);
    
        $title = "Edition du projet·JE";
        
        $this->setVariables(compact("title", "project"));
        $this->render("editProject");
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
        
        $online = (isset($online))?1:0;

        if($online !== $project_info['online']){
            $this->Projects->setProject($id, "online", $online);
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
