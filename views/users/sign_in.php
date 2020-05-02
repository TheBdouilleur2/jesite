

<div class="row d-flex justify-content-center">
  <div class="col">
    <form class="bord" method="POST" action="/connect_user">
      <?php if(isset($_SESSION['error']) && !empty($_SESSION['error'])){?>
          <div class="alert alert-danger" role="alert">
          <?=$_SESSION['error']?>
          </div>
      <?php }?>
      <h1>Connexion</h1>
      <div class="form-group">
      <label for="username_connect">Pseudo</label>
      <input autofocus type="text" name="username_connect" id="username_connect" class="form-control" placeholder="Votre pseudo" aria-describedby="helpId">
      </div>
      <div class="form-group">
        <label for="passwd_connect">Mot de passe</label>
        <input type="password" class="form-control" name="passwd_connect" id="passwd_connect" placeholder="Votre mot de passe">
      </div>
      <div class="form-check">
        <label class="form-check-label" for="rememderme">
          <input type="checkbox" name="rememderme" id="rememderme" value="checkedValue"><span class="checkmark"></span>
          Se souvenir de moi
        </label>
      </div>

      <input type="submit" name="formconnection" value="Je me connecte" />
    </form>
  </div>
</div>