<!-- La page de création d'un projet -->

<?php if(isset($_SESSION['error']) && !empty($_SESSION['error'])){?>
      <div class="alert alert-danger" role="alert">
      <?=$_SESSION['error']?>
      </div>
<?php }?>

<p>Les champs marqués d'une * sont à renseigner obligatoirement.</p>
<form action="/create_project" method="POST" id="creation_project">
   <div class="form-group">
      <label for="project_title">Titre*:</label>
      <input class="form-control" type="text" placeholder="Votre titre" id="project_title" name="project_title" value="<?php if(isset($_SESSION['project_info']['project_title'])){echo $_SESSION['project_info']['project_title'];}?>"/>
      <div class="container d-flex justify-content-end">
            <div class="row d-flex justify-content-end">
                <div class="col">
                    <a href="https://www.markdownguide.org/cheat-sheet/" target="_blank" title="Tuto Markdown">
                    <svg xmlns="http://www.w3.org/2000/svg" width="108" height="18" viewBox="0 0 208 128"><rect width="198" height="118" x="5" y="5" ry="10" stroke="#000" stroke-width="10" fill="none"/><path d="M30 98V30h20l20 25 20-25h20v68H90V59L70 84 50 59v39zm125 0l-30-33h20V30h20v35h20z"/></svg>
                    </a>
                </div>
            </div>
        </div>
   </div>
   <div class="form-group">
      <label for='tags'>Entrer ici les tags séparés par des / :</label>
      <input class="form-control" type="text" placeholder="tag1/tag2/..." id="tags" name="tags" value="<?php if(isset($_SESSION['project_info']['tags'])){echo $_SESSION['project_info']['tags'];}?>" />
   </div>
   <div class="form-group">
      <label for="summary">Résumé*:</label>
      <textarea class="form-control" placeholder="Votre résumé" id="summary" name="summary"><?php if(isset($_SESSION['project_info']['summary'])){echo $_SESSION['project_info']['summary'];}?></textarea>
      <div class="container d-flex justify-content-end">
            <div class="row d-flex justify-content-end">
                <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" width="108" height="18" viewBox="0 0 208 128"><rect width="198" height="118" x="5" y="5" ry="10" stroke="#000" stroke-width="10" fill="none"/><path d="M30 98V30h20l20 25 20-25h20v68H90V59L70 84 50 59v39zm125 0l-30-33h20V30h20v35h20z"/></svg>
                </div>
            </div>
        </div>
   </div>
   <div class="form-group">
      <label for="project_content">Corps du projet*:</label>
      <textarea class="form-control" placeholder="Votre contenu" id="project_content" name="project_content"><?php if(isset($_SESSION['project_info']['project_content'])){echo $_SESSION['project_info']['project_content'];}?></textarea>
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
       <input type="checkbox" class="form-check-input" name="online" id="online" value="checkedValue" checked>
       Mettre en ligne
     </label>
   </div>
   <input type="submit" name="creationform" value="Création du projet" />
</form>
