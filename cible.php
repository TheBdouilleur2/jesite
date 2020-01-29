<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Merci de votre avis</title>
	<link rel="stylesheet" href="style/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
</head>
<body>
	<?php
	if (isset($_POST["avisdusitepositif"])) {
		$avis_simple = "positif";
	}
	else{
		$avis_simple = "qui nous permetra d'améliorer le site";
	}
	if (isset($_POST['prenom']) && !empty($_POST['prenom'])) {
		$_SESSION['msg']= 'Merci beaucoup '.htmlspecialchars($_POST["prenom"]).' de votre avis '.$avis_simple;
		$pseudo = htmlspecialchars($_POST['prenom']);
	}else if(isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo'])){
		$_SESSION['msg']= 'Merci beaucoup '.htmlspecialchars($_SESSION['pseudo']).' de votre avis '.$avis_simple;
		$pseudo = htmlspecialchars($_SESSION['pseudo']);
	}

	try {
    $bddavis = new PDO('mysql:host=localhost;dbname=jesite', 'jesite_user', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    die('Erreur : '.$e->getMessage());
  }
	$envoi = $bddavis->prepare('INSERT INTO avis_visiteurs(Prenom, avis_simple, avis) VALUES(?, ?, ?)');
	if(isset($_POST['avisdusitepositif'])){
		$avis_simple = 'positif';
	}else{
		$avis_simple = 'négatif';
	}
	$envoi->execute(array($pseudo, $avis_simple, $_POST['avis']));
	header('Location: index.php');
	?>
</body>
</html>
