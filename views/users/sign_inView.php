<?php $title = "Se connecter"; ?>
<?php ob_start(); ?>
   <p>Veuillez vous connecter.</p>
   	<form method="POST" id="sign-in">
       <table>
            <tr>
               <td align="right">
                  <label for="username_connect">Pseudo :</label>
               </td>
               <td>
                  <input autofocus type="text" placeholder="Votre pseudo" id="username_connect" name="username_connect" maxlenght='20' value="<?php if(isset($username)) { echo $username; } ?>" />
               </td>
            </tr>
            <tr>
               <td align="right">
                  <label for="passwd_connect">Mot de passe :</label>
               </td>
               <td>
                  <input type="password" placeholder="Votre mot de passe" id="passwd_connect" name="passwd_connect" />
               </td>
            </tr>
            <tr>
               <td align="right">
                  <input type="checkbox" name="rememberme" id="rememberme">
               </td>
               <td>
                  <label for="rememberme">Se souvenir de moi</label>
               </td>
            </tr>
            <tr>
               <td></td>
               <td align="center">
                  <br />
                  <input type="submit" name="formconnection" value="Je me connecte" />
               </td>
            </tr>
         </table>
   	</form>
   
<script type="text/javascript" src="public/js/sign_inForm.js"></script>
<?php $content=ob_get_clean();
require("views/templates/template.php");
?>