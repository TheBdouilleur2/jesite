<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/models/CommentsManager.php');

$CommentsManager = new CommentsManager;

//TODO récuperer l'id du projet

$comments = $CommentsManager->getCommentsByProject(14);

foreach($project["comments"] as $comment){ ?>
    <div class="comment bord">
			<p><a href="/profile/<?=$comment['sender_id']?>" class="unlike"><strong>@<?php echo htmlspecialchars($comment['sender']); ?></strong></a>[<?php echo $comment['age'];?>]: <?=$comment['msg']?></p>
	</div>
<?php }