<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="/public/style/style.css">
	<link rel='shortcut icon' href="/public/Images/Pythonsign.ico">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
	<header>
		<?php require_once('controllers/php/functions.php') ?>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="/index.php">
		    <img src="/public/Images/logo.png" alt="Logo des JE">
 		</a>
		<ul class="navbar-nav mr-auto">
			<li class='nav_item'><a class="nav-link" href="/index.php">Accueil</a></li>
			<?php
			if(isset($_SESSION['ID'], $_SESSION['state']) AND $_SESSION['state']=='admin'){?>
				<li class='nav-item'><a class="nav-link" href="/admin">Espace admin</a></li>
			<?php } ?>
			<!-- <li>Articles</li> -->
			<li class='nav-item'><a class="nav-link" href="/projects" class="nav-link">Projets</a></li>
			<?php if(isset($_SESSION['ID']) AND $_SESSION['state']=='admin'){ ?>
				<li class="nav-item dropdown">
        				<a class="nav-link dropdown-toggle" href="/chats" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          					Discussions
        				</a>
        				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          					<a class="dropdown-item" href="/chat">Discussion utilisateur</a>
						<a class="dropdown-item" href="/admin/chat">Discussion admin</a>
        				</div>
      				</li>
			<?php } else if(isset($_SESSION['ID'])){ ?>
				<li class='nav-item'><a class="nav-link" href='/chat'>Discussion</a></li>
			<?php } else{ ?>
				<!-- <li class='nav-item'><a class="nav-link" href='/show'>Donner un avis</a></li> -->
			<?php }?>
			
			</ul>
				<div class="navbar-brand">
				<?php
					$date = getTheDate();
					echo $date;
				?>
			</div>
			<div>
			<?php if(isset($_SESSION['ID'])){ ?>
				<div class='navbar-brand nav-link dropdown' href="/profile">
					<span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="userMenu"><?=$_SESSION['username']?></span>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
						<a href="/account" class="dropdown-item">Mon compte</a>
						<a href="/deconnection" class="dropdown-item">Déconnexion</a>
					</div>
				</div>
			<?php }else{?>
				<a href="/sign_in">
				<div class="sign">
					<img src="/public/Images/sign-in.png" alt="Sign-in">
				</div>
				</a>
				<a href="/sign_up">
					<div class="sign">
						<img src="/public/Images/sign-up.png" alt="Sign-up">
					</div>
				</a>
			<?php } ?>
		</div>
	</nav>
	
	</header>

<section class="container">
	<a href="https://github.com/TheBdouillleur2/jesite" class="github-corner" aria-label="View source on GitHub"><svg width="80" height="80" viewBox="0 0 250 250" style="fill:#fff; color:#343A40; position: absolute; top: 0; border: 0; right: 0;" aria-hidden="true"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg></a>
<?= $contentForTemplate ?>
</section>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
