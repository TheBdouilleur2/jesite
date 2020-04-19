<?php ob_start(); ?>
<h1>Mon compte</h1>
<br>
<form method="POST" id="edit_profile">
    <div class="form-group">
        <label for="new_username">Pseudo :</label>
        <input type="text" placeholder="Votre pseudo" id="new_username" name="new_username" maxlenght='20' value="<?php if(isset($_SESSION['username'])) { echo $_SESSION['username']; } ?>" />
    </div>
    <div class="form-group">
        <label for="new_mail">Adresse mail :</label>
        <input type="email" placeholder="Votre mot de passe" id="new_mail" name="new_mail" value="<?php if(isset($_SESSION['mail'])) { echo $_SESSION['mail']; } ?>" />
    </div>
    <div class="form-group">
      <label for="bio">Bio:</label>
      <textarea class="form-control" name="bio" id="bio" placeholder="Parler nous un peu de vous (Markdown suporté)"><?php if(isset($_SESSION['bio'])) { echo $_SESSION['bio']; } ?></textarea>
    </div>
    <div class="form-group">
        <label for="new_passwd">Nouveau mot de passe :</label>
        <input type="password" placeholder="Votre mot de passe" id="new_passwd" name="new_passwd" />
    </div>
    <div class="form-group">
        <label for="new_passwd2">Confirmation du mot de passe :</label>
        <input class='form-control' type="password" placeholder="Confirmer votre mot de passe" id="new_passwd2" name="new_passwd2" />
    </div>
    <button class='btn btn-primary' type="submit" name="formconnection">Modifier mon compte</button>
</form>
   
<script type="text/javascript" src="public/js/profileForm.js"></script>
<?php $content=ob_get_clean();
require_once("views/templates/template.php");
?>