<?php 
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/models/ProjectsManager.php");

$ProjectManager = new ProjectsManager();

extract($_POST);

$project_info = $ProjectManager->getProject($id);

if(isset($newtitle) && !empty($newtitle) && $newtitle != $project_info['title']){
  $titre_exist = $ProjectManager->titleTest($newtitle);
  if (!$titre_exist) {
    $ProjectManager->setTitle((int)$id, $newtitle);
    $success = 1;
  }else{
    $msg = 'Ce titre est déjà utilisé';
  }
}

if(isset($newcontent) && !empty($newcontent) && $newcontent != $project_info['content']){
    $ProjectManager->setContent($id, $newcontent);
    $success = 1;
}
  
if(isset($newsummary) && !empty($newsummary) && $newsummary != $project_info['summary']){
    if (strlen($newsummary) < 500) {
        $ProjectManager->setSummary($id, $newsummary);
        $success = 1;
    }else{
      $msg = 'Le résumé est trop long.';
    }
}

if(isset($newtags) && !empty($newtags) && $newtags != $project_info['tags']){
    $ProjectManager->setTags($id, $newtags);
    $success = 1;
}

if($success === 1){
    $_SESSION['msg'] = "Modification effectuée";
}

echo json_encode(compact("success", "msg"));