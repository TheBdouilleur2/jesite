<form id='send_msg' >
	<div class="form-group">
		<label for="msg" ><?php echo $_SESSION['username']; ?>:</label>
        <textarea autofocus class="form-control" id="msg" name='msg'></textarea>
        <div class="container d-flex justify-content-end">
            <div class="row d-flex justify-content-end">
                <div class="col">
		    <a href="https://www.markdownguide.org/cheat-sheet/" title="Tuto Markdown">
                    <svg xmlns="http://www.w3.org/2000/svg" width="108" height="18" viewBox="0 0 208 128"><rect width="198" height="118" x="5" y="5" ry="10" stroke="#000" stroke-width="10" fill="none"/><path d="M30 98V30h20l20 25 20-25h20v68H90V59L70 84 50 59v39zm125 0l-30-33h20V30h20v35h20z"/></svg>
		    </a>
                </div>
            </div>
        </div>
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