
<nav class="nav nav-pills nav-fill">
  <a class="nav-item nav-link" href="/profile/<?=$_SESSION['ID']?>">Mon profil</a>
  <a class="nav-item nav-link active" href="#">Mes informations</a>
</nav>

<h1>Mon compte</h1>
<br>
<form method="POST" id="edit_profile">
    <div class="form-group">
        <label for="new_username">Pseudo :</label>
        <input class="form-control" type="text" placeholder="Votre pseudo" id="new_username" name="new_username" maxlenght='20' value="<?php if(isset($_SESSION['username'])) { echo $_SESSION['username']; } ?>" />
    </div>
    <div class="form-group">
        <label for="new_mail">Adresse mail :</label>
        <input class="form-control" type="email" placeholder="Votre mot de passe" id="new_mail" name="new_mail" value="<?php if(isset($_SESSION['mail'])) { echo $_SESSION['mail']; } ?>" />
    </div>
    <div class="form-group">
      <label for="bio">Bio:</label>
      <textarea class="form-control" name="bio" id="bio" placeholder="Parler nous un peu de vous"><?php if(isset($_SESSION['bio'])) { echo $_SESSION['bio']; } ?></textarea>
      <div class="container d-flex justify-content-end">
            <div class="row d-flex justify-content-end">
                <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" width="108" height="18" viewBox="0 0 208 128"><rect width="198" height="118" x="5" y="5" ry="10" stroke="#000" stroke-width="10" fill="none"/><path d="M30 98V30h20l20 25 20-25h20v68H90V59L70 84 50 59v39zm125 0l-30-33h20V30h20v35h20z"/></svg>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="skills">Compétences (séparées par des /):</label>
        <input class="form-control" type="text" placeholder="Quels languages connaissez vous?" id="skills" name="skills" value="<?php if(isset($_SESSION['skills'])) { echo $_SESSION['skills']; } ?>"/>
    </div>
    <div class="form-group">
        <label for="new_passwd">Nouveau mot de passe :</label>
        <input class="form-control" type="password" placeholder="Votre mot de passe" id="new_passwd" name="new_passwd" />
    </div>
    <div class="form-group">
        <label for="new_passwd2">Confirmation du mot de passe :</label>
        <input class='form-control' type="password" placeholder="Confirmer votre mot de passe" id="new_passwd2" name="new_passwd2" />
    </div>
    <button class='btn btn-primary' type="submit" name="formconnection">Modifier mon compte</button>
</form>
   
<script type="text/javascript" src="public/js/profileForm.js"></script>
