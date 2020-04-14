<?php $title = 'Créer un projet'?>

<?php ob_start(); ?>

<!-- La page de création d'un projet -->

<p>Les champs marqués d'une * sont à renseigner obligatoirement.</p>
<form method="POST" id="creation_project">
   <div class="form-group">
      <label for="project_title">Titre*:</label>
      <input class="form-control" type="text" placeholder="Votre titre" id="project_title" name="project_title" />
   </div>
   <div class="form-group">
      <label for="project_content">Corp du projet*:</label>
      <textarea class="form-control" placeholder="Votre contenu" id="project_content" name="project_content"></textarea>
   </div>
   <div class="form-group">
      <label for="summary">Resumé*:</label>
      <textarea class="form-control" placeholder="Votre resumé" id="summary" name="summary"></textarea>
   </div>
   <div class="form-group">
      <label for='tags'>Entrer ici les tags séparés par des / :</label>
      <input class="form-control" type="text" placeholder="tag1/tag2/..." id="tags" name="tags" value="<?php if(isset($tags)) { echo $tags; } ?>" />
   </div>
   <input type="submit" name="creationform" value="Creation du project" />
</form>
<p id="error" style="color: red;"><?php if(isset($error)){echo $error;} ?></p>

<script src="public/js/newProject.js"></script>

<?php $content = ob_get_clean();?>
<?php require(ROOT . '/views/templates/template.php');?>
