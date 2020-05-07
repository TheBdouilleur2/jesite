<!-- La page de modification d'un projet -->

<?php if(isset($_SESSION['error']) && !empty($_SESSION['error'])){?>
      <div class="alert alert-danger" role="alert">
      <?=$_SESSION['error']?>
      </div>
<?php }?>

<p>Les champs marqués d'une * sont à renseigner obligatoirement.</p>
<form id="project_edition" method="POST" action="/set_project">
    <div class="from-group">
        <label for="newtitle">Titre*:</label>
        <input class="form-control" type="text" placeholder="Votre titre" id="newtitle" name="newtitle" value="<?=$project['title']?>" />
        <div class="container d-flex justify-content-end">
            <div class="row d-flex justify-content-end">
                <div class="col">
                    <a href="https://www.markdownguide.org/cheat-sheet/" title="Tuto Markdown">
                    <svg xmlns="http://www.w3.org/2000/svg" width="108" height="18" viewBox="0 0 208 128"><rect width="198" height="118" x="5" y="5" ry="10" stroke="#000" stroke-width="10" fill="none"/><path d="M30 98V30h20l20 25 20-25h20v68H90V59L70 84 50 59v39zm125 0l-30-33h20V30h20v35h20z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="from-group">
        <label for="newtags">Tags:</label>
        <input class="form-control" type="text" id="newtags" name='newtags' value="<?=$project['tags']?>">
    </div>
    <div class="from-group">
        <label for="newsummary">Résumé*:</label>
        <textarea class="form-control" placeholder="Votre résumé" id="newsummary" name="newsummary" ><?= nl2br($project['summary'])?></textarea>
        <div class="container d-flex justify-content-end">
            <div class="row d-flex justify-content-end">
                <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" width="108" height="18" viewBox="0 0 208 128"><rect width="198" height="118" x="5" y="5" ry="10" stroke="#000" stroke-width="10" fill="none"/><path d="M30 98V30h20l20 25 20-25h20v68H90V59L70 84 50 59v39zm125 0l-30-33h20V30h20v35h20z"/></svg>
                </div>
            </div>
        </div>
    </div>
    <div class="from-group">
        <label for="newcontent">Contenu*:</label>
        <textarea class="form-control" placeholder="Votre contenu" id="newcontent" name="newcontent" ><?=nl2br($project['content'])?></textarea>
        <div class="container d-flex justify-content-end">
            <div class="row d-flex justify-content-end">
                <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" width="108" height="18" viewBox="0 0 208 128"><rect width="198" height="118" x="5" y="5" ry="10" stroke="#000" stroke-width="10" fill="none"/><path d="M30 98V30h20l20 25 20-25h20v68H90V59L70 84 50 59v39zm125 0l-30-33h20V30h20v35h20z"/></svg>
                </div>
            </div>
        </div>
    </div>
    <div class="form-check">
     <label for="online" class="form-check-label">
       <input type="checkbox" class="form-check-input" name="online" id="online" value="checkedValue" <?=($project['online']==='1')?"checked":""?>>
       Mettre en ligne
     </label>
   </div>
    <input type="text" hidden name='id' id='id' value="<?=$project['ID']?>">
    <input type="submit" name="formedition" value="Sauvegarder les modifications" />  
</form>
