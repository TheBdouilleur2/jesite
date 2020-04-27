<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/CommentsManager.php');

$CommentsManager = new CommentsManager;

if($_SESSION['loadCommentsProjectId']){
	$comments = $CommentsManager->getCommentsByProject((int)$_SESSION['loadCommentsProjectId']);

	foreach($comments as $comment){ ?>
		<div class="comment">
				<p><a href="/profile/<?=$comment['sender_id']?>" class="unlike"><strong>@<?php echo htmlspecialchars($comment['sender']); ?></strong></a>[<?php echo $comment['age'];?>]: <?=$comment['msg']?></p>
		</div>
	<?php }
}
