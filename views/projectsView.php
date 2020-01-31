<?php $title = 'Projets'?>

<?php ob_start(); ?>

<!-- La page d'affichage des projets -->
<?php foreach($projects as $project) { 
    $tags = explode($project['tags'], "/");
    ?>
    <a href='index.php?url=project/<?=$project['ID'] ?>' class='unlink'>
			<div class="project">
				<p><strong><?=$project['title']?></strong>  publié le <?=$project['date_fr']?> par <strong>@<?=$project['creator']?></strong></p>
				<p><?=nl2br($project['summary'])?></p>
                <?php foreach ($tags as  $tag) { ?>
                    <span class="badge"><?=$tag?></span>
                <?php } ?>
				<?php if (isset($_SESSION['state']) && $_SESSION['state']=="admin") {?>
					<a href="index.php?url=edit_project/<?=$project['ID']?>" class='button'>Modifier le projet.</a>
                    <a href="index?url=delete_project/<?=$project['ID']?>" class='button'>Suprimer le projet.</a>
                <?php } ?>
<?php }?>

<?php $content = ob_get_clean();?>
<?php require('views/template.php');?>