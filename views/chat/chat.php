<form id='send_msg' >
	<div class="form-group">
		<label for="msg" ><?php echo $_SESSION['username']; ?>:</label>
		<textarea autofocus class="form-control" id="msg" name='msg'></textarea>
		<input type="text" hidden value='user' name='category' id='category'>
	</div>
	<input type='submit' class="btn btn-outline-dark" name='send_msg' value="Poster" />
</form>

<hr>

<div id="msgs_user">
    <?php
    foreach($messages as $message) {?>
		<div class="msg">
			<p><a href="/profile/<?=$message['sender_ID']?>" class="unlike"><strong>@<?php echo htmlspecialchars($message['sender']); ?></strong></a>[<?= $message['age']?>]: <?php echo $message['msg']; ?></p>
		</div>
	<?php } ?>
</div>

<!-- <nav aria-label="Page navigation messages">
    <ul class="pagination">
        <?php if(($page-1) >0){ ?>
            <li class="page-item"><a class="page-link" href="/chat/<?=$page-1?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
        <?php } else{ ?>
            <li class="page-item disabled"><a class="page-link" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
        <?php }
        
        for ($i=1; $i <= $nbPage; $i++) {
            if($page === $i){ ?>
                <li class="page-item active"><a class="page-link" href="/chat/<?=$i?>"><?=$i?></a></li>
            <?php }else{ ?>
                <li class="page-item"><a class="page-link" href="/chat/<?=$i?>"><?=$i?></a></li>
            <?php }
        }?>

        <?php if(($page+1) <=$nbPage){ ?>
            <li class="page-item"><a class="page-link" href="/chat/<?=$page+1?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
        <?php } else{ ?>
            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
        <?php }?>
    </ul>
</nav> -->

<script src='public/js/chatForm.js'></script>
<script>
	setInterval( 'loadMessages()' , 2000);
	function loadMessages(){
		$('#msgs_user').load('../controllers/php/loadMessages.php');
	}
</script>