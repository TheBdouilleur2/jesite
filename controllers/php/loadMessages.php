<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/ChatManager.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/php/functions.php');

$chatManager = new ChatManager();


$messages = $chatManager->getUsersMessages(1, 20);
$sending_dates = array();
foreach($messages[2] as $sending_date){
    $sending_dates[] = getOld($sending_date);
}
for ($i = 0; $i< count($messages[0]) ; $i++) {?>
	<div class="msg">
		<p><strong>@<?php echo htmlspecialchars($messages[0][$i]); ?></strong>[<?= $sending_dates[$i]?>]: <?php echo $messages[1][$i]; ?></p>
	</div>
<?php } ?>