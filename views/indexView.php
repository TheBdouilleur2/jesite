<?php $title = 'Accueil·Jeunes Experts'?>
<?php ob_start(); ?>

<!-- La page d'accueil -->
<h1>Bonjour, <?php if(isset($_SESSION['id'])){ echo htmlspecialchars($_SESSION['username']);} ?> bienvenue sur le site des J-E</h1>


<?php $content = ob_get_clean();?>
<?php require_once('views/templates/template.php');?>