<?php $title = $project['title']?>

<?php ob_start(); ?>

<!-- La page d'affichage d'un projet' -->
<h1><?=$project['title']?></h1>
    <p>Publié le <?=$project['date_fr']?> par <strong>@<?=$project['creator']?></strong><?php foreach ($tags as $tag) { ?>
        <span class="badge"><?$tag?></span>
    <?php } ?></p>
    <?php if (isset($_SESSION['state']) && $_SESSION['state']=="admin") {?>
					<a href="index.php?url=edit_project/<?=$project['ID']?>" class='button'>Modifier le projet.</a>
                    <a href="index?url=delete_project/<?=$project['ID']?>" class='button'>Suprimer le projet.</a>
	<?php	} ?>
    <?= $content ?>
<br>
<hr>
<!-- Affichage des commmentaires -->
<?php $content = ob_get_clean();?>
<?php require('views/template.php');?>