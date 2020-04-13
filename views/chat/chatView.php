<?php ob_start(); ?>
<form id='send_msg' >
	<div class="form-group">
		<label for="msg" ><?php echo $_SESSION['username']; ?>:</label>
		<textarea autofocus class="form-control" id="msg" name='msg'></textarea>
		<input type="text" hidden value='<?=$chat_category?>' name='category' id='category'>
	</div>
	<input type='submit' name='send_msg' value="Poster" />
</form>

<hr>

<div id="msgs_<?=$chat_category?>">
	<?php
	for ($i = 0; $i< count($messages[0]) ; $i++) {?>
		<div class="msg">
			<p><strong>@<?php echo htmlspecialchars($messages[0][$i]); ?></strong>[<?= $sending_dates[$i]?>]: <?php echo $messages[1][$i]; ?></p>
		</div>
	<?php } ?>
</div>

<script src='public/js/chatForm.js'></script>
<script>
	setInterval( 'loadMessages()' , 2000);
	function loadMessages(){
		$('#msgs_admin').load('../controllers/php/loadAdminMessages.php');
		$('#msgs_user').load('../controllers/php/loadMessages.php');
	}
</script>

<?php $content = ob_get_clean();?>
<?php require('views/templates/template.php');?>