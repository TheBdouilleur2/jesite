<?php $title = "Creer un compte"; ?>
<?php ob_start(); ?>
   <p>Veuillez creer un compte.</p>
   	<p>Les champs marqué d'une * sont à renseigner obligatoirement.</p>
   	<form action='' method="POST" id="sign-up">
       <table>
            <tr>
               <td align="right">
                  <label for="username">Pseudo :</label>
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
                  <label for="mail2">Confirmation du mail :</label>
               </td>
               <td>
                  <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
               </td>
            </tr>
            <tr>
               <td align="right">
                  <label for="passwd">Mot de passe :</label>
               </td>
               <td>
                  <input type="password" placeholder="Votre mot de passe" id="passwd" name="passwd" />
               </td>
            </tr>
            <tr>
               <td align="right">
                  <label for="passwd2">Confirmation du mot de passe :</label>
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
      <p><?php if (isset($error)) {
         echo $error;
      } ?></p>
<?php $content=ob_get_clean();
require("views/template.php");
?>