<?php
//TODO: Suprimer le champ message dans la table user.

require_once($_SERVER['DOCUMENT_ROOT'] . '/models/Manager.php');
/**
 * Model to manage users.
 */
class UsersManager extends Model{
  /*
    $limit: number max of users which select.
  */
  public function getUsers(int $limit){
    $users = $this->db->prepare('SELECT * FROM users ORDER BY id DESC LIMIT ?,?');
    if($limit == 10){
      $users->execute(array(0, $limit));
    }elseif($limit > 10){
      $users->execute(array($limit-10, $limit));
    }else{
      $users = $this->db->query('SELECT * FROM users ORDER BY id DESC');
    }
    return $users;
  }

  public function getUser($username){
    $user = $this->db->prepare('SELECT * FROM users WHERE username=?');
    $user->execute(array($username));
    $user_info = $user->fetch();
    return $user_info;
  }

  /* getUserByID:
  get all field of an user by his ID. */
  public function getUserByID(int $id){
    $user = $this->db->prepare('SELECT * FROM users WHERE ID=?');
    $user->execute(array($id));
    $user_info = $user->fetch();
    return $user_info;
  }

  /* createUser: 
  params: username, mail and password
  insert the user into the database users. */
  public function createUser(string $username, string $mail, string $passwd){
    $passwd = password_hash($passwd, PASSWORD_DEFAULT, ["cost" => 12]);
    $insert_user = $this->db->prepare("INSERT INTO users (username, mail, passwd, state) VALUES(?, ?, ?, ?)");
    $insert_user->execute(array($username, $mail, $passwd, 'user'));
    $insert_user->closeCursor();
  }

  /* setUser:
  Change a value of an user like his username or password.
  params: - ID of the user 
          - name of the field we would change
          - change value 
          not functional*/
  public function setUser(int $user_id, string $field_name, $new_value){
    $set_user = $this->db->prepare("UPDATE users SET ?=? WHERE ID=?");
    $set_user->execute(array($field_name, $new_value, $user_id));
    $set_user->closeCursor();
  }

    /* setUsername:
  Change a value of an user's username.
  params: - ID of the user 
          - change value */
  public function setUsername(int $user_id, $new_value){
    $user_info = $this->getUserByID($user_id);
    $set_user = $this->db->prepare("UPDATE users SET `username`=?, passwd=? , login_date=? WHERE ID=?");
    $set_user->execute(array($new_value, $user_info['passwd'], $user_info['login_date'], $user_id));
    $set_user->closeCursor();
  }

      /* setMail:
  Change a value of an user's mail.
  params: - ID of the user 
          - change value */
  public function setMail(int $user_id, $new_value){
    $user_info = $this->getUserByID($user_id);
    $set_user = $this->db->prepare("UPDATE users SET `mail`=?, `passwd`=? , `login_date`=? WHERE ID=?");
    $set_user->execute(array($new_value, $user_info['passwd'], $user_info['login_date'], $user_id));
    $set_user->closeCursor();
  }

  /* setPasswd:
  Change a value of an user's passwd.
  params: - ID of the user 
          - change value */
  public function setPasswd(int $user_id, $new_passwd){
    $passwd = password_hash($new_passwd, PASSWORD_DEFAULT, ["cost" => 12]);
    $user_info = $this->getUserByID($user_id);
    $set_user = $this->db->prepare("UPDATE users SET `username`=?, login_date=? WHERE ID=?");
    $set_user->execute(array($new_passwd, $user_info['login_date'], $user_id));
    $set_user->closeCursor();
  }

      /* setUsername:
  Change a value of an user's state.
  params: - ID of the user 
          - change value */
    public function setState(int $user_id, $new_value){
        if($new_value === 'admin' || $new_value === 'user'){
      
            $user_info = $this->getUserByID($user_id);
            $set_user = $this->db->prepare("UPDATE users SET `state`=?, passwd=? , login_date=? WHERE ID=?");
            $set_user->execute(array($new_value, $user_info['passwd'], $user_info['login_date'], $user_id));
            $set_user->closeCursor();
        }
        return False;
    }

    /**
     * Set the user's bio
     * @param int $user_id The ID of user
     */
    public function setBio(int $user_id, $new_value){

      $user_info = $this->getUserByID($user_id);
      $set_user = $this->db->prepare("UPDATE users SET `bio`=?, passwd=? , login_date=? WHERE ID=?");
      $set_user->execute(array($new_value, $user_info['passwd'], $user_info['login_date'], $user_id));
      $set_user->closeCursor();
    }

    /**
     * Set the user's skills
     * @param int $user_id The ID of user
     */
    public function setSkills(int $user_id, $new_value){

      $user_info = $this->getUserByID($user_id);
      $set_user = $this->db->prepare("UPDATE users SET `skills`=?, passwd=? , login_date=? WHERE ID=?");
      $set_user->execute(array($new_value, $user_info['passwd'], $user_info['login_date'], $user_id));
      $set_user->closeCursor();
    }


  /**connectUser:
  *If there is cookie auth, the user is connected. 
  */
  public function connectUser(){
    if(isset($_COOKIE['auth'])){
      $auth = $_COOKIE['auth'];
      $auth = explode("--", $auth);

      $req_user = $this->db->prepare("SELECT * FROM users WHERE ID=?");
      $req_user->execute(array((int)$auth[0]));
      $user_info = $req_user->fetchAll();
      $is_user_exist = $req_user->rowCount();
      if ($is_user_exist == 1) {
        $key = sha1($user_info['username'].$user_info['passwd']);
        if($key == $auth[1]){
          setcookie('auth', $user_info['ID']."--".sha1($key), time()+365*24*60*60, "/", null, false, true);
          $_SESSION = (array)$user_info;
        }else{
          setcookie('auth','', time()-3600);
        }
      }
      $req_user->closeCursor();
    }
  }

  /* userTest:
  Check if the user whith username exist
  return: True -> if the username is used
          False -> if the username is not used. */
  public function userTest($user){
    $username = htmlspecialchars($user);
    $reqUserTest = $this->db->prepare('SELECT * FROM users WHERE username=?');
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

  public function deleteUser(int $id){
    if($this->getUserByID($id)){
      $req_delete = $this->db->prepare("DELETE FROM users WHERE ID=?");
      $req_delete->execute(array($id));
      return True;
    }else{
      return False;
    }
  }
}
?>
