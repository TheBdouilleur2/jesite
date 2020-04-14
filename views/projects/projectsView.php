<?php ob_start(); ?>
<!-- La page d'affichage des projets -->

<?php while($project = $projects->fetch()){ 
    $tags = explode("/", $project['tags']);    ?>
    <a href='project/<?=$project['ID'] ?>' class="unlike">
		<div class="project">
            <p><strong><?=$project['title']?></strong>  publié le <?=$project['date_fr']?> par <strong>@<?=$project['creator']?></strong>
            <?php foreach($tags as $tag) { ?>
                <span class="badge badge-secondary"><?=$tag?></span>
            <?php } ?>
            </p>
			<p><?=nl2br($Parsedown->line($project['summary']))?></p>
	    	<?php if(isset($_SESSION['state']) && $_SESSION['state']=="admin"){?>
		    	<a href="edit_project/<?=$project['ID']?>" role='button' class='btn btn-sm btn-success' >Modifier le projet.</a>
                <a href="delete_project/<?=$project['ID']?>" role='button' class='btn btn-sm btn-danger' >Suprimer le projet.</a>
            <?php } ?>
        </div>
    </a>
<?php }?>

<?php
if(isset($_SESSION['ID']) && $_SESSION['state'] === 'admin'){ ?>
    <a href="new_project" role="button" class='btn btn-sm btn-primary'>Nouveau Projet</a>

<?php }?>

<?php $content = ob_get_clean();?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/views/templates/template.php');?>
