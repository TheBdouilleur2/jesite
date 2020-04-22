<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/Manager.php");

/**
 * 
 */
class ChatsManager extends Model
{
	public function getUsersMessages($page, $perPage){
		$db = $this->dbConnect();
    $begin = ($page-1)*4;
    $req_messages = $db->query("SELECT m.ID ID, sender_ID, u.username sender, m.msg msg, sending_date FROM usersChat m INNER JOIN users u ON u.ID = m.sender_id ORDER BY m.ID DESC LIMIT $begin,$perPage");
    $messages = $req_messages->fetchAll();
    $req_messages->closeCursor();
    return $messages;
  }

  public function getAdminMessages($page, $perPage){
		$db = $this->dbConnect();
    $begin = ($page-1)*4;
    $req_messages = $db->query("SELECT m.ID ID, sender_ID, u.username sender, m.msg msg, sending_date FROM adminChat m INNER JOIN users u ON u.ID = m.sender_id ORDER BY m.ID DESC LIMIT $begin,$perPage");
    $messages = $req_messages->fetchAll();
    $req_messages->closeCursor();
    return $messages;
	}
  
  public function getNumberUsersMessages(){
      $db = $this->dbConnect();
      $req_number = $db->query("SELECT COUNT(ID) AS nbMessages FROM usersChat");
      $data = $req_number->fetch();
      $nbMessages = $data['nbMessages'];
      $req_number->closeCursor();
      return $nbMessages;
  }

  public function getNumberAdminMessages(){
    $db = $this->dbConnect();
    $req_number = $db->query("SELECT COUNT(ID) AS nbMessages FROM adminChat");
    $data = $req_number->fetch();
    $nbMessages = $data['nbMessages'];
    $req_number->closeCursor();
    return $nbMessages;
}

  public function postUserMessage($msg, $sender_id){
    $db = $this->dbConnect();
    $post_message = $db->prepare("INSERT INTO usersChat (`sender_ID`, `msg`) VALUES(?, ?)");
    $post_message->execute(array($sender_id, $msg));
    $post_message->closeCursor(); 
  }


  public function postAdminMessage($msg, $sender_id){
    $db = $this->dbConnect();
    $post_message = $db->prepare("INSERT INTO adminChat (`sender_ID`, `msg`) VALUES(?, ?)");
    $post_message->execute(array($sender_id, $msg));
    $post_message->closeCursor(); 
  }
}