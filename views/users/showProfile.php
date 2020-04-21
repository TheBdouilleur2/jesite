<?php ob_start(); ?>

<?php if($_SESSION['ID'] === $user_info['ID']){ ?>
    <nav class="nav nav-pills nav-fill">
        <a class="nav-item nav-link active" href="#">Mon profil</a>
        <a class="nav-item nav-link" href="/account">Mes informations</a>
    </nav>
    <br>
<?php } ?>

<h1><?=$user_info['username']?></h1> <span>compte créé <?=$user_info['age']?></span>

<?php if(!empty($user_info['bio'])){?>
<div class="bord">
    <p>Bio:</p>
    <p><?=$user_info['bio']?></p>
</div>
<?php }if(!empty($user_info['skills'][0])){?>
<div class="bord">
    <p>Compétences:</p>
    <p>
        <?php foreach($user_info['skills'] as $skill){ ?>
            <span class="badge badge-info"><?=$skill?></span>
        <?php }?>
    </p>
</div>
<?php } if(!empty($user_info['projects']->rowCount())){?>
<div class="bord">
    <p>Ses projets:</p>
    <?php while($project = $user_info['projects']->fetch()){ ?>
        <a href='/project/<?=$project['ID'] ?>' class="unlike">
            <div class="project">
                <div class="row">
                    <p class="col"><strong><?=$project['title']?></strong>  publié le <?=$project['date_fr']?>
                    <?php if(count($tags)){
                            foreach($tags as $tag) { ?>
                                <span class="badge badge-secondary"><?=$tag?></span>
                    <?php }} ?>
                    </p>
                </div>
            <p><?=nl2br($Parsedown->line($project['summary']))?></p>
            </div>
        </a>
    <?php } ?>
</div>
<?php }?>

<?php $content=ob_get_clean();
require_once("views/templates/template.php");
?>