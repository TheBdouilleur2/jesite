<!-- La page d'affichage des projets -->
<div class="row">
<div class="col-10">
    <?php foreach($projects as $project){  ?>
        <a href='/project/<?=$project['ID'] ?>' class="unlike">
            <div class="project">
                <div class="row">
                    <p class="col"><strong><?=$project['title']?></strong>  publié le <?=$project['date_fr']?> par <strong>@<?=$project['creator']?></strong>
                    <?php foreach($project["tags"] as $tag) { ?>
                        <span class="badge badge-secondary"><?=$tag?></span>
                    <?php } ?>
                    </p>
                    <div class="col">
                    <?php if((isset($_SESSION['state']) && $_SESSION['state']=="admin") || (isset($_SESSION['ID']) && $_SESSION['username'] === $project['creator'])){?>
                        <a href="/edit_project/<?=$project['ID']?>" role='button' class='btn btn-sm btn-primary' >Modifier le projet.</a>
                        <a href="/delete_project/<?=$project['ID']?>" role='button' class='btn btn-sm btn-danger' >
                            <svg class="bi bi-trash-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 00-1 1v1a1 1 0 001 1H3v9a2 2 0 002 2h6a2 2 0 002-2V4h.5a1 1 0 001-1V2a1 1 0 00-1-1H10a1 1 0 00-1-1H7a1 1 0 00-1 1H2.5zm3 4a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7a.5.5 0 01.5-.5zM8 5a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7A.5.5 0 018 5zm3 .5a.5.5 0 00-1 0v7a.5.5 0 001 0v-7z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    <?php } ?>
                    </div>
                </div>
                <p><?=nl2br($project['summary'])?></p>
            </div>
        </a>
    <?php }?>
</div>

<div class="col-2">
    <?php
    if(isset($_SESSION['ID'])){ ?>
        <a href="/new_project" role="button" class='btn btn-sm btn-success'>Nouveau Projet</a>

    <?php }?>
</div>
</div>

<nav aria-label="Page navigation projets">
    <ul class="pagination">
        <?php if(($page-1) >0){ ?>
            <li class="page-item"><a class="page-link" href="/projects/<?=$page-1?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
        <?php } else{ ?>
            <li class="page-item disabled"><a class="page-link" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
        <?php }
        
        for ($i=1; $i <= $nbPage; $i++) {
            if($page === $i){ ?>
                <li class="page-item active"><a class="page-link" href="/projects/<?=$i?>"><?=$i?></a></li>
            <?php }else{ ?>
                <li class="page-item"><a class="page-link" href="/projects/<?=$i?>"><?=$i?></a></li>
            <?php }
        }?>

        <?php if(($page+1) <=$nbPage){ ?>
            <li class="page-item"><a class="page-link" href="/projects/<?=$page+1?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
        <?php } else{ ?>
            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
        <?php }?>
    </ul>
</nav>