<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/ChatsManager.php');

$ChatsManager = new ChatsManager();


$messages = $ChatsManager->getUsersMessages(1, 20);
foreach($messages as $message) {?>
	<div class="msg">
		<p><a href="/profile/<?=$message['sender_ID']?>" class="unlike"><strong>@<?php echo htmlspecialchars($message['sender']); ?></strong></a>[<?= $message['age']?>]: <?php echo $message['msg']; ?></p>
	</div>
<?php } ?>