<?php $title = 'Créer un projet·JE'?>

<?php ob_start(); ?>

<!-- La page de création d'un projet -->

<?php if(isset($_SESSION['error']) && !empty($_SESSION['error'])){?>
      <div class="alert alert-danger" role="alert">
      <?=$_SESSION['error']?>
      </div>
<?php }?>

<p>Les champs marqués d'une * sont à renseigner obligatoirement.</p>
<form action="/create_project" method="POST" id="creation_project">
   <div class="form-group">
      <label for="project_title">Titre*:</label>
      <input class="form-control" type="text" placeholder="Votre titre" id="project_title" name="project_title" value="<?php if(isset($_SESSION['project_info']['project_title'])){echo $_SESSION['project_info']['project_title'];}?>"/>
   </div>
   <div class="form-group">
      <label for='tags'>Entrer ici les tags séparés par des / :</label>
      <input class="form-control" type="text" placeholder="tag1/tag2/..." id="tags" name="tags" value="<?php if(isset($_SESSION['project_info']['tags'])){echo $_SESSION['project_info']['tags'];}?>" />
   </div>
   <div class="form-group">
      <label for="summary">Resumé*:</label>
      <textarea class="form-control" placeholder="Votre resumé" id="summary" name="summary"><?php if(isset($_SESSION['project_info']['summary'])){echo $_SESSION['project_info']['summary'];}?></textarea>
   </div>
   <div class="form-group">
      <label for="project_content">Corps du projet*:</label>
      <textarea class="form-control" placeholder="Votre contenu" id="project_content" name="project_content"><?php if(isset($_SESSION['project_info']['project_content'])){echo $_SESSION['project_info']['project_content'];}?></textarea>
   </div>
   <input type="submit" name="creationform" value="Création du projet" />
</form>

<!-- <script src="public/js/newProject.js"></script> -->

<?php $content = ob_get_clean();?>
<?php require_once(ROOT . '/views/templates/template.php');?>
