<?php
session_start();

try {
	$bdd_membres = new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
	die('Erreur : '.$e->getMessage());
}
include_once('cookie_connect.php');

	if (isset($_POST['formconnection'])) {
			$pseudo_connect = htmlspecialchars($_POST['pseudo_connect']);
			$mdp_connect = sha1($_POST['mdp_connect']);
			if (!empty($pseudo_connect) && !empty($mdp_connect)) {
				$req_user = $bdd_membres->prepare("SELECT * FROM membres WHERE pseudo=? AND mdp=?");
				$req_user->execute(array($pseudo_connect, $mdp_connect));
				$user_exist = $req_user->rowCount();
				$req_user->closeCursor();
				if ($user_exist == 1) {
					$user_info = $req_user->fetch();
					$_SESSION['id'] = $user_info['ID'];
					$_SESSION['pseudo'] = $user_info['pseudo'];
					$_SESSION['mail'] = $user_info['mail'];
					$_SESSION['status'] = $user_info['status'];
					$_SESSION['msg'] = $user_info['msg'];
					if(isset($_POST[rememberme])){
						setcookie('pseudo', $pseudo_connect, time()+365*24*60*60);
						setcookie('mdp', $mdp_connect, time()+365*24*60*60);
					}
					header('Location: index.php');
				}else{
					$erreur = 'Pseudo et mot de passe inconnus, si vous n\'avez pas de compte, créé en un <a href="sign-up.php">ici</a>';
				}
			}else{
				$erreur = 'Tout les champs doivent être remplis';
			}
		}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign in</title>
	<link rel="stylesheet" href="style/style.css">
	<link rel='shortcut icon' href="Images/Pythonsign.ico">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">

</head>
<body>
	<p>Veuillez vous connecter pour entrer sur le site.</p>
	<p>Les champs marqué d'une * sont à renseigner obligatoirement.</p>
	<form action='' method="POST" id="sign-in">
		<table>
               <tr>
                  <td align="right">
                     <label for="pseudo">Pseudo :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre pseudo" id="pseudo_connect" name="pseudo_connect"/>
                  </td>
               </tr>
							 <tr>
                  <td align="right">
                     <label for="mdp">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Votre mot de passe" id="mdp_connect" name="mdp_connect" />
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
                     <input type="submit" name="formconnection" value="Connexion" />
                  </td>
               </tr>
            </table>
         </form>
	</form>
	<p id="erreur" style="color: red;"><?php if(isset($erreur)){echo $erreur;} ?></p>
</body>
</html>
