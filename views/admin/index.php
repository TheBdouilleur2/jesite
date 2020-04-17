<?php ob_start(); ?>

<!-- La page d'accueil de la section d'administration -->
<div class="users">
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
          <?php while($user = $users->fetch()){ ?>
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
                      "<a type='button' class='btn btn-danger supr' href='".$user['ID']."'>Supprimer</a>"?>
                      </td>
                </tr>
          <?php } ?>
      </tbody>
    </table>
</div>

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
          <?php while($project = $projects->fetch()){ ?>
                <tr class="bg-light">
                    <th scope="row"><?=$project['ID']?></th>
                    <td><a href="/project/<?=$project['ID']?>"><?=$project['title']?></a></td>
                    <td><?=$project['creator']?></td>
                    <td><?=$Parsedown->line($project['summary']);?></td>
                    <td>
                      <a type='button' class='btn btn-danger' href='/delete_project/<?=$project['ID']?>'>Supprimer</a>
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
