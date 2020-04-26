<?php ob_start(); ?>

<!-- Navigation entre les onglets -->
<nav>
  <ul class="nav nav-pills">
    <li class="nav-item">
      <a class="nav-link" href="/admin">Utilisateurs</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="#">Projets</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/chat">Chat</a>
    </li>
  </ul>
</nav>
<br>

<div class="projects">
  <table class="table table-hover">
    <thead class='thead-dark'>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Titre</th>
        <th scope='col'>Créateur</th>
        <th scope='col'>Résumé</th>
        <th scope='col'>Suprimer</th>
      </tr>
    </thead>
    <tbody>
       <?php foreach($projects as $project){ ?>
              <tr class="bg-light">
                  <th scope="row"><?=$project['ID']?></th>
                  <td><a href="/project/<?=$project['ID']?>"><?=$project['title']?></a></td>
                  <td><?=$project['creator']?></td>
                  <td><?=$project['summary']?></td>
                  <td>
                    <a type='button' class='btn btn-danger' href='/delete_project/<?=$project['ID']?>'>
                      <svg class="bi bi-trash-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M2.5 1a1 1 0 00-1 1v1a1 1 0 001 1H3v9a2 2 0 002 2h6a2 2 0 002-2V4h.5a1 1 0 001-1V2a1 1 0 00-1-1H10a1 1 0 00-1-1H7a1 1 0 00-1 1H2.5zm3 4a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7a.5.5 0 01.5-.5zM8 5a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7A.5.5 0 018 5zm3 .5a.5.5 0 00-1 0v7a.5.5 0 001 0v-7z" clip-rule="evenodd"/>
                      </svg>
                    </a>
                  </td>
              </tr>
        <?php } ?>
    </tbody>
  </table>
</div>

<script src="public/js/admin.js"></script>

<?php $content = ob_get_clean();?>
<?php require_once('views/templates/adminTemplate.php');?>