<form action="/create_user" method="POST"class="bord">
   <?php if(isset($_SESSION['error']) && !empty($_SESSION['error'])){?>
      <div class="alert alert-danger" role="alert">
      <?=$_SESSION['error']?>
      </div>
   <?php }?>
   <h1>Creer un compte</h1>
   <p>Les champs marqués d'une * sont à renseigner obligatoirement.</p>
   <div class="form-group">
     <label for="username">Pseudo*:</label>
     <input autofocus type="text" name="username" id="username" class="form-control" placeholder="Votre pseudo" aria-describedby="helpId">
     <small id="helpId" class="text-muted">Le pseudo ne doit pas dépasser 20 caractères</small>
   </div>
   <div class="form-group">
     <label for="mail">Mail:</label>
     <input type="email" name="mail" id="mail" class="form-control" placeholder="Votre mail" aria-describedby="helpId">
   </div>
   <div class="form-group">
     <label for="passwd">Mot de passe* :</label>
     <input type="password" class="form-control" name="passwd" id="passwd" placeholder="Votre mot de passe">
   </div>
   <div class="form-group">
     <label for="passwd2">Confirmation du mot de passe* :</label>
     <input type="password" class="form-control" name="passwd2" id="passwd2" placeholder="Confirmez votre mot de passe">
   </div>
   <div class="form-check">
     <label class="form-check-label" for="rememderme">
       <input type="checkbox" name="rememderme" id="rememderme" value="checkedValue"><span class="checkmark"></span>
       Se souvenir de moi
     </label>
   </div>
   <input type="submit" name="formregistration" value="Je m'inscris" />
</form>

