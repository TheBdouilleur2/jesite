
<div id='header'>
	<div>
		<header>
			<h1>Bonjour, <?php if(isset($_SESSION['id'])){ echo htmlspecialchars($_SESSION['pseudo']);} ?> bienvenue sur le site des J-E</h1>
			<?php
			/* Fonction sans parametres qui renvoi un <p> avec la date du jour.*/
				function donnerLaDate(){
					$jour = date('d');
					$mois = date('m');
					$annee = date('Y');
					$heure = date('H');
					$minutes = date('i');
					$jours_de_semaine = array('Dimanche' , 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
					$jour_de_semaine = date('w');

					echo '<p>'. $jours_de_semaine[$jour_de_semaine]. '/' . $jour . '/' .$mois . '/' .$annee. '</p>';
				}
			 ?>
			 <div style='margin-left:20px;'>
			 	<?php
			 		donnerLaDate();
					if (isset($nbvue)) {
						echo $nbvue. ' vues'; // Pour afficher le nombre de vues de la pages.
					}
			 	 ?>
				 </div>
		</header>
		<!--
			Menu du site des je en php inclu dans les differentes pages.
		 -->

		<nav>
				<ul>
					<li><a href="index.php"><?php
						if(isset($_SESSION['status']) && $_SESSION['status'] == 'admin') {
							echo 'Accueil';?></a>
							<ul class='hidden' >
								<li><a href="index.php">Utilisateurs</a></li>
								<li><a href="espace_admin.php">Administrateurs</a></li>
							</ul>
				<?php } 	else{
							echo 'Accueil';
						}?></li>
					<!-- <li>Actualités</li> -->
					<li><a href="project.php">Projets en cours</a></li>
					<li><a href="<?php if(isset($_SESSION['pseudo'])){echo "discussions.php";}
					else{ echo 'avis.php';} ?>"> <?php
						if(isset($_SESSION['status']) && $_SESSION['status'] == 'admin') {
							echo 'Discussions';?></a>
							<ul class='hidden'>
								<li><a href="discussions.php">Utilisateurs</a></li>
								<li><a href="chat_admin.php">Administrateurs</a></li>
							</ul>
				<?php } else if(isset($_SESSION['pseudo'])){
					echo 'Discussions';
				}
					else{
							echo 'Donner un avis';
						}?>
						</li>
				</ul>
		</nav>
	</div>
	<div class="icones">
		<?php if(isset($_SESSION['pseudo'])){ ?>
			
			<div class="edition">
					<a href="edition_profil.php">
						<img src="Images/edition_profil.png" alt="Editer votre profil">
						<p>Votre profil</p>
					</a>
			</div>
			<div>
				 <a href="deconnection.php"><img src="Images/deconnection.png" alt="Deconnection"></a>
			</div>
		 <?php }else{			 ?>
			 <a href="sign-in.php">
				 <div class="sign">
					 <img src="Images/sign-in.png" alt="Sign-in">
					 <p>Sign-in</p>
				 </div>
			 </a>
			 <a href="sign-up.php">
				 <div class="sign">
					 <img src="Images/sign-up.png" alt="Sign-up">
					 <p>Sign-up</p>
				 </div>
			 </a>
			 <?php
		 }
			?>
	</div>
</div>
