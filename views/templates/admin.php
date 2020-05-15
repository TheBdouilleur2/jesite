<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Ajout du style: -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="/public/style/style.css">
	<link rel='shortcut icon' href="/public/Images/Pythonsign.ico">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet"><!-- TODO ajouter la police roboto -->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="/index.php">
		    <img src="/public/Images/logo.png" alt="Logo des JE">
 		</a>
		<ul class="navbar-nav mr-auto">
			<li class='nav_item'><a class="nav-link" href="/index.php">Accueil</a></li>
			<li class='nav-item'><a class="nav-link" href="/admin">Espace admin</a></li>
			<!-- <li>Articles</li> -->
			<li class='nav-item'><a class="nav-link" href="/projects" class="nav-link">Projets</a></li>
			<li class="nav-item dropdown">
        		<a class="nav-link dropdown-toggle" href="/chats" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          			Discussions
        		</a>
    			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="/chat">Discussion utilisateur</a>
					<a class="dropdown-item" href="/admin/chat">Discussion admin</a>
    			</div>
      		</li>
		</ul>
				<div class="navbar-brand d-none d-md-block">
				<?= $date ?>
			</div>
			<div>
			<div class='navbar-brand nav-link dropdown' href="/profile">
				<span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="userMenu"><?=$_SESSION['username']?></span>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
					<a href="/account" class="dropdown-item">Mon compte</a>
					<a href="/deconnection" class="dropdown-item">Déconnexion</a>
				</div>
			</div>
		</div>
	</nav>
	
	</header>

<section class="container">
<?= $contentForTemplate ?>
</section>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
