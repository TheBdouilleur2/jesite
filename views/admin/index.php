<?php ob_start(); ?>

<!-- La page d'accueil de la section d'administration -->
<div class="users">
<h1>Utilisateurs:</h1>
    <table class="table table-hover">
      <thead class='thead-dark'>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Pseudo</th>
          <th scope='col'>Permissions</th>
          <th scope='col'>Supprimer</th>
        </tr>
      </thead>
      <tbody>
          <?php foreach($users as $user){ ?>
                <tr class="bg-<?= ($user['state']=='admin')?'dark text-light':'light' ?>">
                    <th scope="row"><?=$user['ID']?></th>
                    <td><?=$user['username']?></td>
                    <td>
                    <?=($user['ID']===$_SESSION['ID'])?
                    "<button type='button' class='btn btn-warning'>".$user['state']."</button>" : 
                    "<a type='button' class='btn btn-warning perm' data-toggle='tooltip' data-placement='right' title='Changer les permissions' href='".$user['ID']."'>".$user['state']."</a>" ?>
                    </td>
                    <td>
                      <?=($user['ID']===$_SESSION['ID'])?
                      'Vous':
                      "<a type='button' class='btn btn-danger supr' href='".$user['ID']."'>
                      <svg class='bi bi-trash-fill' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                        <path fill-rule='evenodd' d='M2.5 1a1 1 0 00-1 1v1a1 1 0 001 1H3v9a2 2 0 002 2h6a2 2 0 002-2V4h.5a1 1 0 001-1V2a1 1 0 00-1-1H10a1 1 0 00-1-1H7a1 1 0 00-1 1H2.5zm3 4a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7a.5.5 0 01.5-.5zM8 5a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7A.5.5 0 018 5zm3 .5a.5.5 0 00-1 0v7a.5.5 0 001 0v-7z' clip-rule='evenodd'/>
                      </svg>
                      </a>"?>
                      </td>
                </tr>
          <?php } ?>
      </tbody>
    </table>
</div>

<div class="projects">
<h1>Projets:</h1>
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
                    <td><?=$Parsedown->line($project['summary']);?></td>
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
<!-- TODO: Ajouter le chat admin à coté. -->

<script src="public/js/admin.js"></script>

<?php $content = ob_get_clean();?>
<?php require_once('views/templates/adminTemplate.php');?>
