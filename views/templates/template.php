<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel='shortcut icon' href="public/Images/Pythonsign.ico">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
				<li class='nav-item'><a class="nav-link" href="admin_space">Espace admin</a></li>
			<?php } ?>
			<!-- <li>Articles</li> -->
			<!--<li class='nav-item'><a class="nav-link" href="projects" class="nav-link">Projets en cours</a></li> -->
			<?php if(isset($_SESSION['ID']) AND $_SESSION['state']=='admin'){ ?>
				<li class="nav-item dropdown">
        				<a class="nav-link dropdown-toggle" href="chats" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          					Discussions
        				</a>
        				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          					<a class="dropdown-item" href="chat">Discussion utilisateur</a>
						<a class="dropdown-item" href="chat_admin">Discussion admin</a>
        				</div>
      				</li>
			<?php } else if(isset($_SESSION['ID'])){ ?>
				<li class='nav-item'><a class="nav-link" href='chat'>Discussion</a></li>
			<?php } else{ ?>
				<!-- <li class='nav-item'><a class="nav-link" href='show'>Donner un avis</a></li> -->
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
			<a class='navbar-brand nav-link' href="profile">
				<?=$_SESSION['username']?>
			</a>
		<div>
			<a href="deconnection">
			<img src="public/Images/deconnection.png" alt="Deconnection"></a>
		</div>
	 	<?php }else{?>
			<a href="sign_in">
			<div class="sign">
				<img src="public/Images/sign-in.png" alt="Sign-in">
			</div>
		</a>
		<a href="sign_up">
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