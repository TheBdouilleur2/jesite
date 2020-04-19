<?php $title = 'Accueil·Jeunes Experts'?>
<?php ob_start(); ?>

<!-- La page d'accueil -->
<h1>Bonjour, <?php if(isset($_SESSION['id'])){ echo htmlspecialchars($_SESSION['username']);} ?> bienvenue sur le site des J-E</h1>

<br />
<h2>Voici nos derniers projets</h2>

<?php while($project = $lastProjects->fetch()){ ?>
    <a href='project/<?=$project['ID'] ?>' class="unlike">
        <div class="project">
            <div class="row">
                <p class="col"><strong><?=$project['title']?></strong>  publié le <?=$project['date_fr']?> par <strong>@<?=$project['creator']?></strong>
                <?php foreach($tags as $tag) { ?>
                    <span class="badge badge-secondary"><?=$tag?></span>
                <?php } ?>
                </p>
            </div>
        <p><?=nl2br($Parsedown->line($project['summary']))?></p>
        </div>
    </a>
<?php } ?>

<?php $content = ob_get_clean();?>
<?php require_once('views/templates/template.php');?>