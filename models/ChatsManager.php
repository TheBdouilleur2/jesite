<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/Manager.php");
require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."controllers".DIRECTORY_SEPARATOR."php".DIRECTORY_SEPARATOR."functions.php");

/**
 * 
 */
class ChatsManager extends Model
{
	public function getUsersMessages($page, $perPage){
    $begin = ($page-1)*4;
    $messages = $this->find(array("selection"=>"m.ID ID, sender_ID, u.username sender, m.msg msg, sending_date FROM usersChat m INNER JOIN users u ON u.ID = m.sender_id", "order"=>"m.ID DESC", "limit"=>"$begin,$perPage"));
    for($i = 0; $i< count($messages); $i++){
      $messages[$i]['age'] = getOld($messages[$i]['sending_date']);
    }
    return $messages;
  }

  public function getAdminMessages($page, $perPage){
    $begin = ($page-1)*4;
    $messages = $this->find(array("selection"=>"m.ID ID, sender_ID, u.username sender, m.msg msg, sending_date FROM adminChat m INNER JOIN users u ON u.ID = m.sender_id", "order"=>"m.ID DESC", "limit"=>"$begin,$perPage"));
    for($i = 0; $i< count($messages); $i++){
      $messages[$i]['age'] = getOld($messages[$i]['sending_date']);
    }
    return $messages;
	}
  
  public function getNumberUsersMessages(){
      $data = $this->findFirst(array("selection"=>"COUNT(ID) AS nbMessages FROM usersChat"));
      $nbMessages = $data['nbMessages'];
      return $nbMessages;
  }

  public function getNumberAdminMessages(){
    $data = $this->findFirst(array("selection"=>"COUNT(ID) AS nbMessages FROM adminChat"));
    $nbMessages = $data['nbMessages'];
    return $nbMessages;
}

  public function postUserMessage($msg, $sender_id){
    $this->table = "usersChat";
    $post_message = $this->save(array("sender_ID"=>$sender_id, "msg"=>$msg));
  }


  public function postAdminMessage($msg, $sender_id){
    $this->table = "adminChat";
    $post_message = $this->save(array("sender_ID"=>$sender_id, "msg"=>$msg)); 
  }
}