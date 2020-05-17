<?php
require_once("Controller.php");

class ChatController extends Controller{

	public function __construct(){
		if(isset($_SESSION['ID'])){
			$this->loadModel("Chats");
		}else{
			return false;
		}
	}

	public function displayUsersMessages($page = 1){
		if (isset($_SESSION['ID'])) {
			$perPage = 20;
			$nbMessages = $this->Chats->getNumberUsersMessages();
			$nbPage = ceil($nbMessages/$perPage);
	
			$page = !($page>0 && $page<=$nbPage) ? 1 : $page;
	
			$messages = $this->Chats->getUsersMessages($page, $perPage);

			$this->setVariables(array(
				"title"=>"Discussion·JE",
				"messages"=>$messages,
				"page"=>$page, 
				"nbPage"=>$nbPage
			));
			$this->render("chat");
		}else {
			header("Location: index.php");
		}
	}
}
