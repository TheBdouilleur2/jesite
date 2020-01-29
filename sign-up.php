<?php
try {
  $bdd_membres = new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
  die('Erreur : '.$e->getMessage());
}
if (isset($_POST['forminscription'])) {
  if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
			$pseudo = htmlspecialchars($_POST['pseudo']);
			$mail = htmlspecialchars($_POST['mail']);
			$mail2 = htmlspecialchars($_POST['mail2']);
			$mdp = $_POST['mdp'];
			$mdp2 = $_POST['mdp2'];
			$pseudolength = strlen($pseudo);
      if($pseudolength <= 255) {
        $req_pseudo = $bdd_membres->prepare("SELECT * FROM membres WHERE pseudo=?");
        $req_pseudo->execute(array($pseudo));
        $pseudo_exist = $req_pseudo->rowCount();
        $req_pseudo->closeCursor();
        if($pseudo_exist == 0){
           if($mail == $mail2) {
              if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $req_mail = $bdd_membres->prepare("SELECT * FROM membres WHERE mail=?");
                $req_mail->execute(array($mail));
                $mail_exist = $req_mail->rowCount();
                $req_mail->closeCursor();
                if($mail_exist == 0){
                  if($mdp == $mdp2) {
                    $mdp = sha1($_POST['mdp']);
                    $msg = 'Votre compte a bien été créé!';
                      $insertmbr = $bdd_membres->prepare("INSERT INTO membres(pseudo, mail, mdp, msg) VALUES(?, ?, ?, ?)");
                      $insertmbr->execute(array($pseudo, $mail, $mdp, $msg));
                      if(isset($_POST[rememberme])){
                        setcookie('pseudo', $pseudo, time()+365*24*60*60, null, null, false, true);
                        setcookie('mdp', $mdp, time()+365*24*60*60, null, null, false, true);
                      }
                      $insertmbr->closeCursor();
                      header('Location: index.php');
                    } else {
                         $erreur = "Vos mots de passes ne correspondent pas !";
                    }
                  }else{
                    $erreur = "Adresse mail déjà utilisée !";
                  }
              } else {
                 $erreur = "Votre adresse mail n'est pas valide !";
              }
           } else {
              $erreur = "Vos adresses mail ne correspondent pas !";
           }
         }else {
           $erreur = "Le pseudo est déjà utilisé!";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Sign up</title>
	<link rel="stylesheet" href="style/style.css">
  <link rel='shortcut icon' href="Images/Pythonsign.ico">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">

</head>
<body>
	<p>Veuillez creer un compte.</p>
	<p>Les champs marqué d'une * sont à renseigner obligatoirement.</p>
	<form action='' method="POST" id="sign-up">
    <table>
         <tr>
            <td align="right">
               <label for="pseudo">Pseudo :</label>
            </td>
            <td>
               <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
            </td>
         </tr>
         <tr>
            <td align="right">
               <label for="mail">Mail :</label>
            </td>
            <td>
               <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
            </td>
         </tr>
         <tr>
            <td align="right">
               <label for="mail2">Confirmation du mail :</label>
            </td>
            <td>
               <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
            </td>
         </tr>
         <tr>
            <td align="right">
               <label for="mdp">Mot de passe :</label>
            </td>
            <td>
               <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
            </td>
         </tr>
         <tr>
            <td align="right">
               <label for="mdp2">Confirmation du mot de passe :</label>
            </td>
            <td>
               <input type="password" placeholder="Confirmez votre mot de passe" id="mdp2" name="mdp2" />
            </td>
         </tr>
         <tr>
            <td align="right">
               <input type="checkbox" name="rememberme" id="rememberme">
            </td>
            <td>
               <label for="rememberme">Se souvenir de moi</label>
            </td>
         </tr>
         <tr>
            <td></td>
            <td align="center">
               <br />
               <input type="submit" name="forminscription" value="Je m'inscris" />
            </td>
         </tr>
      </table>
	</form>
	<p id="erreur" style="color: red;"><?php if(isset($erreur)){echo $erreur;} ?></p>
</body>
</html>
