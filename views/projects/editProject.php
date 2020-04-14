<?php ob_start(); ?>
<!-- La page de modification d'un projet -->

<p>Les champs marqué d'une * sont à renseigner obligatoirement.</p>
<form id="project_edition">
    <div class="from-group">
        <label for="newtitle">Titre*:</label>
        <input class="form-control" type="text" placeholder="Votre titre" id="newtitle" name="newtitle" value="<?=$project['title']?>" />
    </div>
    <div class="from-group">
        <label for="newcontent">Contenu*:</label>
        <textarea class="form-control" placeholder="Votre contenu" id="newcontent" name="newcontent" ><?=nl2br($project['content'])?></textarea>
    </div>
    <div class="from-group">
        <label for="newsummary">Resumé*:</label>
        <textarea class="form-control" placeholder="Votre resumé" id="newsummary" name="newsummary" ><?= nl2br($project['summary'])?></textarea>   
    </div>
    <div class="from-group">
        <label for="newtags">Tags:</label>
        <input class="form-control" type="text" id="newtags" name='newtags' value="<?=$project['tags']?>">
    </div>
    <input type="text" hidden name='id' id='id' value="<?=$project['ID']?>">
    <input type="submit" name="formedition" value="Sauvegarder les modifications" />  
</form>

<script src="/public/js/editProject.js"></script>

<?php $content = ob_get_clean();?>
<?php require_once(ROOT . '/views/templates/template.php');?>
