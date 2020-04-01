<?php
require('models/Manager.php');
/**
 * Model to manage users.
 */
class UsersManager extends Manager
{
  /*
    $limit: number max of users which select.
  */
  public function getUsers($limit){
    $db = $this->dbConnect();
    $users = $db->prepare('SELECT * FROM users ORDER BY id LIMIT ?,?');
    if($limit == 10){
      $users->execute(array(0, $limit));
    }else{
      $users->execute(array($limit-10, $limit));
    }
    return $users;
  }

  public function getUser($username){
    $db = $this->dbConnect();
    $user = $db->prepare('SELECT * FROM users WHERE username=?');
    $user->execute(array($username));
    $user_info = $user->fetch();
    return $user_info;
  }

  public function createUser($username, $mail, $passwd){
    $db = $this->dbConnect();
    $passwd = password_hash($passwd, PASSWORD_DEFAULT);
    $msg = 'Votre compte à bien été créé!';
    $insert_user = $db->prepare("INSERT INTO users (username, mail, passwd, state,  msg) VALUES(?, ?, ?, ?, ?)");
    $insert_user->execute(array($username, $mail, $passwd, 'user', $msg));
    $insert_user->closeCursor();
  }

  public function setUser($user_id, $field_name, $new_value){
    $db = $this->dbConnect();
    $set_user = $db->prepare('UPDATE users SET ?=? WHERE ID=?');
    $set_user->execute(array($field_name, $new_value, $user_id));
    $set_user->closeCursor();
  }

  public function connectUser(){
    if(isset($_COOKIE['username']) AND isset($_COOKIE['passwd']) && !empty($_COOKIE['username']) && !empty($_COOKIE['passwd'])){
      $db = $this->dbConnect();
      $req_user = $db->prepare("SELECT * FROM users WHERE username=? AND passwd=?");
      $req_user->execute(array($_COOKIE['username'], $_COOKIE['passwd']));
      $is_user_exist = $req_user->rowCount();
      if ($is_user_exist == 1) {
        $user_info = $req_user->fetch();
        $_SESSION['ID'] = $user_info['ID'];
        $_SESSION['username'] = $user_info['username'];
        $_SESSION['mail'] = $user_info['mail'];
        $_SESSION['state'] = $user_info['state'];
        $_SESSION['msg'] = $user_info['msg'];
      }
      $req_user->closeCursor();
    }
  }

  public function userTest($user){
    $db = $this->dbConnect();
    $username = htmlspecialchars($user);
    $reqUserTest = $db->prepare('SELECT * FROM users WHERE username=?');
    $reqUserTest->execute(array($username));
    $is_user_exist = $reqUserTest->rowCount();
    if ($is_user_exist === 0) {
        $reqUserTest->closeCursor();
        return false;
    }else{
        $reqUserTest->closeCursor();
        return true;
    }
  }

  public function mailTest($mail){
    $db = $this->dbConnect();
    $mail = htmlspecialchars($mail);
    $reqUserTest = $db->prepare('SELECT * FROM users WHERE mail=?');
    $reqUserTest->execute(array($mail));
    $is_user_exist = $reqUserTest->rowCount();
    if ($is_user_exist === 0) {
        $reqUserTest->closeCursor();
        return false;
    }else{
        $reqUserTest->closeCursor();
        return true;
    }
  }

  public function passwdTest($passwd){
    $db = $this->dbConnect();
    $passwd = sha1($passwd);
    $reqUserTest = $db->prepare('SELECT * FROM users WHERE passwd=?');
    $reqUserTest->execute(array($passwd));
    $is_user_exist = $reqUserTest->rowCount();
    if ($is_user_exist === 0) {
        $reqUserTest->closeCursor();
        return false;
    }else{
        $reqUserTest->closeCursor();
        return true;
    }
  }
}
?>
