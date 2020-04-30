<?php

require_once("Controller.php");

class AdminController extends Controller{

    public function __construct(){
        if(isset($_SESSION['ID']) && $_SESSION['state'] === 'admin'){
            $this->loadModel("Users");
            $this->loadModel("Projects");
        }else{
            header("Location: /index.php");
        }
    }

    public function index(){
        $title = 'Espace Admin·JE';
        $users = $this->Users->getUsers();
        
        $this->setVariables(compact("title", "users"));
        $this->template = "admin";
        $this->render("admin", "index");
    }

    public function projects(){
        $title = 'Espace Admin Projets·JE';
        $nbProjects = $this->Projects->getProjectsNumber();
        $projects = $this->Projects->getProjects(1, $nbProjects);

        $this->setVariables(compact("title", "projects"));
        $this->template = "admin";
        $this->render("admin", "projects");
    }

}