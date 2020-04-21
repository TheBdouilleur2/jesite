<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/ChatManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/php/functions.php');

$chatManager = new ChatManager();


$messages = $chatManager->getUsersMessages(1, 20);
for($i = 0; $i< count($messages); $i++){
	$messages[$i]['age'] = getOld($messages[$i]['sending_date']);
}
foreach($messages as $message) {?>
	<div class="msg">
		<p><a href="/profile/<?=$message['sender_ID']?>" class="unlike"><strong>@<?php echo htmlspecialchars($message['sender']); ?></strong></a>[<?= $message['age']?>]: <?php echo $message['msg']; ?></p>
	</div>
<?php } ?>