<?php $title = "Discussion"?>

<?php ob_start(); ?>
<form id='send_msg_user'>
	<p><label for="msg"><?php echo $_SESSION['username']; ?>: <input id="msg" type='text' name='msg'/></label>
	<input type='submit' name='send_msg_user'/></p>
</form>

<?php
for ($i = 0; $i< count($messages[0]) ; $i++) {?>
	<div class="msg">
		<p><strong>@<?php echo htmlspecialchars($messages[0][$i]); ?></strong>[<?php echo htmlspecialchars($messages[2][$i]); ?>]: <?php echo $messages[1][$i]; ?></p>
	</div>
<?php } ?>

<script src='public/js/chatForm.js'></script>

<?php $content = ob_get_clean();?>
<?php require('views/template.php');?>