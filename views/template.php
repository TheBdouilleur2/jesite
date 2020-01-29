<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $title ?></title>
	<link rel="stylesheet" href="public/style/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel='shortcut icon' href="public/Images/Pythonsign.ico">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
</head>
<body>
	<header>
		<?php require_once('controllers/php/functions.php') ?>
		<nav class="navbar navbar-expand-lg navbar-light bg-info">
		<a class="navbar-brand" href="index.php">
		    <img src="public/Images/logo2.png" alt="Logo des JE">
 		</a>
		<ul class="navbar-nav mr-auto">
			<li class='nav_item'><a class="nav-link" href="index.php">Accueil</a></li>
			<?php
			if(isset($_SESSION['ID'], $_SESSION['state']) AND $_SESSION['state']=='admin'){?>
				<li class='nav-item'><a class="nav-link" href="index.php?url=admin_space">Espace admin</a></li>
			<?php } ?>
			<!-- <li>Articles</li> -->
			<li class='nav-item'><a class="nav-link" href="index.php?url=projects" class="nav-link">Projets en cours</a></li>
			<?php if(isset($_SESSION['ID']) AND $_SESSION['state']=='admin'){ ?>
				<li class="nav-item dropdown">
        				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          					Discussions
        				</a>
        				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          					<a class="dropdown-item" href="#">Discussion utilisateur</a>
						<a class="dropdown-item" href="#">Discussion admin</a>
        				</div>
      				</li>
			<?php } else if(isset($_SESSION['ID'])){ ?>
				<li class='nav-item'><a class="nav-link" href='index.php?url=chat'>Discussion</a></li>
			<?php } else{ ?>
				<li class='nav-item'><a class="nav-link" href='index.php?url=show'>Donner un avis</a></li>
			<?php }?>
			
		</ul>
			<div class="navbar-brand">
	 		<?php
	 			$date = getTheDate();
	 			echo $date;
			?>
		</div>
		<div class='icones spacebetween'>
		<?php if(isset($_SESSION['ID'])){ ?>
			<a cl=lass='nav-link' href="index.php?url=edit_profil">
			<div class="edition">
				<?=$_SESSION['username']?>
			</div>
			</a>
		<div>
			<a href="index.php?url=deconnection">
			<img src="public/Images/deconnection.png" alt="Deconnection"></a>
		</div>
	 	<?php }else{?>
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
	</nav>
	
	</header>

<section>
<?= $content ?>
</section>
</body>
</html>
