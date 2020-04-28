<?php ob_start(); ?>

<!-- La page d'affichage d'un projet' -->
<h1><?=$project['title']?></h1>
<div class="row">
    <p class="col">Publié le <?=$project['date_fr']?> par <a href="/profile/<?=$project['creator_id']?>"><strong>@<?=$project['creator']?></strong></a> 
    <?php 
        foreach($tags as $k => $tag) {?>
            <span class="badge badge-secondary"><?= $tag ?></span>
    <?php } ?></p>
    <div class="col">
        <?php if((isset($_SESSION['state']) && $_SESSION['state']=="admin") || (isset($_SESSION['ID']) && $_SESSION['username'] === $project['creator'])){?>
            <a href="/edit_project/<?=$project['ID']?>" role='button' class='btn btn-sm btn-primary' >Modifier le projet.</a>
            <a href="/delete_project/<?=$project['ID']?>" role='button' class='btn btn-sm btn-danger' >
            <svg class="bi bi-trash-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M2.5 1a1 1 0 00-1 1v1a1 1 0 001 1H3v9a2 2 0 002 2h6a2 2 0 002-2V4h.5a1 1 0 001-1V2a1 1 0 00-1-1H10a1 1 0 00-1-1H7a1 1 0 00-1 1H2.5zm3 4a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7a.5.5 0 01.5-.5zM8 5a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7A.5.5 0 018 5zm3 .5a.5.5 0 00-1 0v7a.5.5 0 001 0v-7z" clip-rule="evenodd"/></svg>
            </a>
        <?php } ?>
    </div>
</div>
<br>

<p><?=$project["content"]?></p>

<br><hr><br>
<!-- Affichage des commmentaires -->
<?php if(isset($_SESSION['ID'])){ ?>
    <form id='send_comment' >
        <div class="form-group">
            <label for="msg" ><?php echo $_SESSION['username']; ?>:</label>
            <textarea autofocus class="form-control" id="msg" name='msg'></textarea>
            <input type="text" hidden value='user' name='category' id='category'>
        </div>
        <input type='submit' class="btn btn-outline-dark" name='send_comment' value="Poster" />
    </form>
<?php } ?>

<div class="comments">
<?php foreach($project["comments"] as $comment){ ?>
    <div class="comment">
			<p><a href="/profile/<?=$comment['sender_id']?>" class="unlike"><strong>@<?php echo htmlspecialchars($comment['sender']); ?></strong></a>[<?php echo $comment['age'];?>]: <?=$comment['msg']?></p>
	</div>
<?php } ?>
</div>

<script src='/public/js/comments.js'></script>


<?php $content = ob_get_clean();?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/views/templates/template.php');?>