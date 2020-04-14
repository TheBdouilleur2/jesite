<?php ob_start(); ?>

<!-- La page d'affichage d'un projet' -->
<h1><?=$project['title']?></h1>
<p>Publié le <?=$project['date_fr']?> par <strong>@<?=$project['creator']?></strong> 
<?php 
    foreach($tags as $k => $tag) {?>
        <span class="badge badge-secondary"><?= $tag ?></span>
<?php } ?></p>
<?php if (isset($_SESSION['state']) && $_SESSION['state']=="admin") {?>
	<a href="/edit_project/<?=$project['ID']?>" class='btn btn-success btn-sm'>Modifier le projet.</a>
    <a href="/delete_project/<?=$project['ID']?>" class='btn btn-danger btn-sm'>Suprimer le projet.</a>
<?php	} ?>
<br><br>
<p><?=$content?></p>
<br>
<hr>
<!-- Affichage des commmentaires -->
<?php $content = ob_get_clean();?>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/views/templates/template.php');?>