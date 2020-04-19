<?php $title = "Créer un compte·JE"; ?>
<?php ob_start(); ?>
   <p>Veuillez créer un compte.</p>
   	<p>Les champs marqués d'une * sont à renseigner obligatoirement.</p>
   	<form id="sign-up">
       <table>
            <tr>
               <td align="right">
                  <label for="username">Pseudo* :</label>
               </td>
               <td>
                  <input autofocus type="text" placeholder="Votre pseudo" id="username" name="username" maxlenght='20' value="<?php if(isset($username)) { echo $username; } ?>" />
               </td>
            </tr>
            <tr>
               <td align="right">
                  <label for="mail">Mail :</label>
               </td>
               <td>
                  <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
               </td>
            </tr>
            <tr>
               <td align="right">
                  <label for="passwd">Mot de passe* :</label>
               </td>
               <td>
                  <input type="password" placeholder="Votre mot de passe" id="passwd" name="passwd" />
               </td>
            </tr>
            <tr>
               <td align="right">
                  <label for="passwd2">Confirmation du mot de passe* :</label>
               </td>
               <td>
                  <input type="password" placeholder="Confirmez votre mot de passe" id="passwd2" name="passwd2" />
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
                  <input type="submit" name="formregistration" value="Je m'inscris" />
               </td>
            </tr>
         </table>
   	</form>

<script type="text/javascript" src="public/js/sign_upForm.js"></script>
<?php $content=ob_get_clean();
require_once("views/templates/template.php");
?>
