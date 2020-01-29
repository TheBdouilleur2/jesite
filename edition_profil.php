<?php
session_start();
try {
  $bdd_membres = new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
  die('Erreur : '.$e->getMessage());
}
if(isset($_SESSION['id'])){
  $requser = $bdd_membres->prepare('SELECT * FROM membres WHERE id=?');
  $requser->execute(array($_SESSION['id']));
  $user_info = $requser->fetch();

  if (isset($_POST['newpseudo']) && !empty($_POST['newpseudo']) && $_POST['newpseudo'] != $user_info['pseudo']) {
    $newpseudo = htmlspecialchars($_POST['newpseudo']);
    $req_pseudo = $bdd_membres->prepare("SELECT * FROM membres WHERE pseudo=?");
    $req_pseudo->execute(array($newpseudo));
    $pseudo_exist = $req_pseudo->rowCount();
    if ($pseudo_exist == 0) {
      $changepseudo = $bdd_membres->prepare('UPDATE membres SET pseudo=? WHERE ID=?');
      $changepseudo->execute(array($newpseudo, $_SESSION['id']));
      header('Location: index.php');
    }else{
      $erreur = 'Ce pseudo est déjà utilisé';
    }

  }
  if (isset($_POST['newmail']) && !empty($_POST['newmail']) && $_POST['newmail'] != $user_info['mail']) {
    $newmail = htmlspecialchars($_POST['newmail']);
    if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
      $req_mail = $bdd_membres->prepare("SELECT * FROM membres WHERE mail=?");
      $req_mail->execute(array($newmail));
      $mail_exist = $req_mail->rowCount();
      if($mail_exist == 0){
        $changepseudo = $bdd_membres->prepare('UPDATE membres SET mail=? WHERE ID=?');
        $changepseudo->execute(array($newmail, $_SESSION['id']));
        header('Location: index.php');
      }else{
        $erreur = 'Cette adresse mail est deja utilisée';
      }
    }else{
      $erreur = 'Adresse mail non valide';
    }
  }
  if (isset($_POST['newmdp']) && !empty($_POST['newmdp']) && isset($_POST['newmdp2']) && !empty($_POST['newmdp2'])) {
    $mdp1 = sha1($_POST['newmdp']);
    $mdp2 = sha1($_POST['newmdp2']);

    if($mdp1 == $mdp2){
      $changepseudo = $bdd_membres->prepare('UPDATE membres SET mdp=? WHERE ID=?');
      $changepseudo->execute(array($mdp1, $_SESSION['id']));
      header('Location: index.php');
    }else{
      $erreur = "Vos deux mots de passe ne corespondent pas";
    }
$requser->closeCursor();
  }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Edition du profil</title>
 	<link rel="stylesheet" href="style/style.css">
  <link rel='shortcut icon' href="Images/Pythonsign.ico">
 	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
 </head>
<body>
  <h1>Edition du profil</h1>
  <form action="" method="POST">
    <table>
               <tr>
                  <td align="right">
                     <label for="pseudo">Pseudo :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Pseudo" id="newpseudo" name="newpseudo" value="<?php echo $user_info['pseudo'];?>"/>
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mail">Mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Mail" id="newmail" name="newmail" value="<?php echo $user_info['mail'];?>" />
                  </td>
               </tr>
							 <tr>
                  <td align="right">
                     <label for="mdp">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Mot de passe" id="newmdp" name="newmdp" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp">Confirmation du mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Confirmation du mot de passe" id="newmdp2" name="newmdp2" />
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" name="formconnection" value="Enregistrer les modifications" />
                  </td>
               </tr>
            </table>
  </form>
  <p><?php if(isset($erreur)){echo $erreur;} ?></p>
</body>

 <?php
}else{
  header('Location: sign-in.php');
} ?>
