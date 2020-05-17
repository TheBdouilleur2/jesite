<?php

require_once("Controller.php");

class AdminController extends Controller{

    public function __construct(){
        if(isset($_SESSION['ID']) && $_SESSION['state'] === 'admin'){
            $this->loadModel("Users");
            $this->loadModel("Projects");
            $this->loadModel("Chats");
        }else{
            header("Location: /index.php");
        }
    }

    public function index(){
        $title = 'Espace Admin·JE';
        $users = $this->Users->getUsers();
        
        $this->setVariables(compact("title", "users"));
        $this->template = "admin";
        $this->render("index");
    }

    public function projects(){
        $title = 'Espace Admin Projets·JE';
        $nbProjects = $this->Projects->getProjectsNumber();
        $projects = $this->Projects->getProjects(1, $nbProjects);

        $this->setVariables(compact("title", "projects"));
        $this->template = "admin";
        $this->render("projects");
    }

    public function chat($page = 1){
		$perPage = 20;
		$nbMessages = $this->Chats->getNumberAdminMessages();
		$nbPage = ceil($nbMessages/$perPage);
	
		$page = !($page>0 && $page<=$nbPage) ? 1 : $page;
		$messages = $this->Chats->getAdminMessages($page, $perPage);

		$this->setVariables(array(
			"title"=>"Discussion admin·JE",
			"messages"=>$messages,
			"page"=>$page, 
			"nbPage"=>$nbPage
		));
		$this->template = "admin";
		$this->render("chat");
	}

}