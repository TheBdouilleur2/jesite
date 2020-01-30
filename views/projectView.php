<?php $title = $title?>

<?php ob_start(); ?>

<!-- La page d'affichage d'un projet' -->


<?php $content = ob_get_clean();?>
<?php require('views/template.php');?>