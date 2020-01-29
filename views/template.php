<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $title ?></title>
	<link rel="stylesheet" href="public/style/style.css">
	<link rel='shortcut icon' href="public/Images/Pythonsign.ico">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
</head>
<body>
	<header>
		<?php require_once('controllers/php/functions.php') ?>
		<img src="public/Images/logo2.png" alt="Logo des JE">
		<nav>
		<ul>
			<li><a href="index.php"><?php
				if(isset($_SESSION['state']) && $_SESSION['state'] == 'admin') {
					echo 'Accueil';?></a>
					<ul class='hidden' >
						<li><a href="index.php">Utilisateurs</a></li>
						<li><a href="index.php?url=admin_space">Administrateurs</a></li>
					</ul>
				<?php } 	else{
							echo 'Accueil';
				}?>
			</li>
			<!-- <li>Articles</li> -->
			<li><a href="index.php?url=projects" class="nav-link">Projets en cours</a></li>
			<li><a href="<?php if(isset($_SESSION['ID'])){echo "index.php?url=chat";}
				else{ echo 'index.php?url=device';} ?>"> <?php
					if(isset($_SESSION['state']) && $_SESSION['state'] == 'admin') {
						echo 'Discussions';?>
				</a>
					<ul class='hidden'>
						<li><a href="index.php?url=chat">Utilisateurs</a></li>
						<li><a href="index.php?url=chat_admin">Administrateurs</a></li>
					</ul>
			<?php } else if(isset($_SESSION['ID'])){
				echo 'Discussions';
			}
			else{
				echo 'Donner un avis';
			}?>
			</li>
		</ul>
	</nav>
	
	<div>
	 	<?php
	 		$date = getTheDate();
	 		echo $date;
		?>
	</div>
	<div class='icones spacebetween'>
		<?php if(isset($_SESSION['ID'])){ ?>
		<a href="index.php?url=edit_profil">
			<div class="edition">
				<?=$_SESSION['username']?>
			</div>
		</a>
		<div>
			<a href="index.php?url=deconnection">
			<img src="public/Images/deconnection.png" alt="Deconnection"></a>
		</div>
	 <?php }else{			 ?>
		<a href="index.php?url=sign_in">
			<div class="sign">
				<img src="public/Images/sign-in.png" alt="Sign-in">
			</div>
		</a>
		<a href="index.php?url=sign_up">
			<div class="sign">
				<img src="public/Images/sign-up.png" alt="Sign-up">
			</div>
		</a>
		<?php } ?>
	</div>
	</header>

<section>
<?= $content ?>
</section>
</body>
</html>