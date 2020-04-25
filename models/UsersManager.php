<?php
//TODO: Suprimer le champ message dans la table user.

require_once($_SERVER['DOCUMENT_ROOT'] . '/models/Manager.php');
/**
 * Model to manage users.
 */
class UsersManager extends Model{

  public $table = "users";

  
  public function getUsers(){
    $users = $this->find(array("order"=>"id DESC"));
    return $users;
  }

  public function getUser($username){
    $user = $this->findFirst(array("conditions"=>"username=$username"));
    return $user;
  }

  /* getUserByID:
  get all field of an user by his ID. */
  public function getUserByID(int $userId){
    $userId = (int)$userId;
    $user = $this->findFirst(array("conditions"=>"ID=$userId"));
    return $user;
  }

  /* createUser: 
  params: username, mail and password
  insert the user into the database users. */
  public function createUser(string $username, string $mail, string $passwd){
    $passwd = password_hash($passwd, PASSWORD_DEFAULT, ["cost" => 12]);
    $insert_user = $this->save(array("username"=>$username, "mail"=>$mail, "passwd"=>$passwd));
  }

  /* setUser:
  Change a value of an user like his username or password.
  params: - ID of the user 
          - name of the field we would change
          - change value 
          not functional*/
  public function setUser(int $user_id, string $field_name, $new_value){
    $user_info = $this->getUserByID($user_id);
    $this->save(array("ID"=>(int)$user_id, "$field_name"=>$new_value, "passwd"=>$user_info['passwd'], "login_date"=>$user_info["login_date"]));
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

      $user_info = $this->findFirst(array("conditions"=>"ID=$auth[0]"));
      if ($user_info){
        $key = sha1($user_info['username'].$user_info['passwd']);
        if($key == $auth[1]){
          setcookie('auth', $user_info['ID']."--".$key, time()+365*24*60*60, "/", null, false, true);
          $_SESSION = (array)$user_info;
        }else{
          setcookie('auth','', time()-3600);
        }
      }
    }
  }

  /* userTest:
  Check if the user whith username exist
  return: True -> if the username is used
          False -> if the username is not used. */
  public function userTest($user){
    $username = htmlspecialchars($user);
    $reqUserTest = $this->findFirst(array("conditions"=>"username='$username'"));
    if (!$reqUserTest) {
        return false;
    }else{
        return true;
    }
  }

  public function deleteUser(int $userId){
    if($this->getUserByID($userId)){
      $this->delete((int)$userId);
      return True;
    }else{
      return False;
    }
  }
}
?>
