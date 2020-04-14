<?php $title = 'Créer un projet'?>

<?php ob_start(); ?>

<!-- La page de création d'un projet -->

<p>Les champs marqués d'une * sont à renseigner obligatoirement.</p>
<form action='' method="POST" id="creation_project">
    <table>
        <tr>
            <td align="right">
               <label for="projecttitle">Titre*:</label>
            </td>
            <td>
               <input type="text" placeholder="Votre titre" id="projecttitle" name="projecttitle" value="<?php if(isset($projecttitle)) { echo $projecttitle; } ?>" />
            </td>
        </tr>
        <tr>
            <td align="right">
               <label for="projectcontent">Corp du projet*:</label>
            </td>
            <td>
               <textarea placeholder="Votre contenu" id="projectcontent" name="projectcontent" rows="40" cols="60"><?php if(isset($projectcontent)) { echo $projectcontent; } ?></textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
               <label for="summary">Resumé*:</label>
            </td>
            <td>
               <textarea placeholder="Votre resumé" id="summary" name="summary" rows="10" cols="60"><?php if(isset($summary)) { echo $summary; } ?></textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
               <label for="tags">Tags:</label>
            </td>
            <td>
            	<p>Entrer ici les tags séparés par des / :</p>
               <input type="text" placeholder="tag1/tag2/..." id="tags" name="tags" value="<?php if(isset($tags)) { echo $tags; } ?>" />
            </td>
        </tr>
        <tr>
            <td></td>
            <td align="center">
               <br />
               <input type="submit" name="creationform" value="Creation du project" />
            </td>
        </tr>
    </table>
</form>
<p id="error" style="color: red;"><?php if(isset($error)){echo $error;} ?></p>



<?php $content = ob_get_clean();?>
<?php require($_SERVER['DOCUMENT_ROOT'] . 'views/templates/template.php');?>
