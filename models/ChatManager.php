<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/Manager.php");

/**
 * 
 */
class ChatManager extends Manager
{
	public function getUsersMessages(){
		$db = $this->dbConnect();
    $req_messages = $db->query('SELECT m.ID ID, u.username sender, m.msg msg, send_date FROM userschat m INNER JOIN users u ON u.ID = m.sender_id ORDER BY m.ID DESC');
    $senders = array();
    $msgs = array();
    $sending_dates = array();
    while ($message = $req_messages->fetch()) {
      $senders[] = $message['sender'];
      $msgs[] = $message['msg'];
      $sending_dates[] = $message['send_date'];
    }  
    $req_messages->closeCursor();
    $messages = array($senders, $msgs, $sending_dates);
    return $messages;
	}

  public function postUserMessage($msg){
    $db = $this->dbConnect();
    $post_message = $db->prepare("INSERT INTO userschat ('sender_ID', 'msg') VALUES(?, ?)");
    $post_message->execute(array($_SESSION['id'], $msg));
    $post_message->closeCursor();
  }
}