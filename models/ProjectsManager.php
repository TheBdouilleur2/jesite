<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/Manager.php');
require_once('CommentsManager.php');


/**
 * Model to manage projects.
 */
class ProjectsManager extends Model
{
    public $table = "projects";
    public $Comments = false;

    public function __construct()
    {
        parent::__construct();
        $this->Comments = new CommentsManager;
    }


    /**
     * Renvoie les differents projets.
     */
    public function getProjects($page, $perPage, int $online = 1){
        $begin = ($page-1)*4;
        $projects = $this->find(array("selection"=>"p.ID ID, u.username creator, p.title title, p.summary summary, DATE_FORMAT(publication_date, '%d/%m/%Y à %Hh%imin') AS date_fr, tags FROM projects p INNER JOIN users u ON u.ID = p.creator_id", "order"=>"publication_date DESC", "limit"=>"$begin,$perPage", "conditions"=>"online=$online"));
        for ($i=0; $i < count($projects); $i++) { 
            $projects[$i]["summary"] = $this->Parsedown->line($projects[$i]["summary"]);
            $projects[$i]["tags"] = explode("/", $projects[$i]["tags"]);
        }
        return $projects; 
    }

    /**
     * Renvoie les differents projets d'un utilisateur.
     * @param int $id ID de l'utilisateur
     * @return array $projects Projets de l'utilisateur
     */
    public function getProjectsByUser(int $userId, int $page = 1, int $perPage = 4, $online=false){
        $begin = ($page-1)*4;
        $userId = (int)$userId;

        $selection = "p.ID ID, p.creator_id, u.username creator, p.title title, p.summary summary, p.online online, DATE_FORMAT(publication_date, '%d/%m/%Y à %Hh%imin') AS date_fr, tags FROM projects p INNER JOIN users u ON u.ID = p.creator_id WHERE p.creator_id=$userId ";

        if($online){
            $online = (int)$online;
            $conditions = "online=$online";
            $selection .= "AND $conditions ";
        }

        $projects = $this->find(array("selection"=>$selection, "order"=>"publication_date DESC", "limit"=>"$begin,$perPage"));
        for ($i=0; $i < count($projects); $i++) { 
            $projects[$i]["summary"] = $this->Parsedown->line($projects[$i]["summary"]);
            $projects[$i]["tags"] = explode("/", $projects[$i]["tags"]);
        }
        return $projects;
    }

    public function getProject(int $project_id, bool $parsedown=true){
        $project_id = (int)$project_id;
        $project = $this->findFirst(array("selection"=>"p.ID ID, u.username creator, p.creator_id creator_id, p.title title, p.content content, p.summary summary, p.online online,  publication_date, DATE_FORMAT(publication_date, '%d/%m/%Y à %Hh%imin') AS date_fr,  tags FROM projects p INNER JOIN users u ON u.ID = p.creator_id", "conditions"=>"p.ID=$project_id"));
        if($parsedown){
            $project['comments'] =  $this->Comments->getCommentsByProject($project_id); 
            $project['content'] = $this->Parsedown->text($project['content']);
            $project["tags"] = explode("/", $project["tags"]);
        }
        return $project; 
    }

    public function getProjectsNumber(int $online = 1){
        $data = $this->findFirst(array("selection"=>"COUNT(ID) AS nbProjects FROM projects", "conditions"=>"online=$online"));
        $nbProjects = $data['nbProjects'];
        return $nbProjects;
    }

    public function getProjectsNumberByUser(int $userId, int $online = 1){
        $userId = (int)$userId;
        $data = $this->findFirst(array("selection"=>"COUNT(ID) AS nbProjects FROM projects", "conditions"=>"online=$online AND creator_id=$userId"));
        $nbProjects = $data['nbProjects'];
        return $nbProjects;
    }

    public function createProject(string $title, int $creatorID, string $content, string $summary, string $tags, int $online = 1){
        $title = htmlspecialchars($title);
        $creatorID = (int)$creatorID;
        $this->save(array("title"=>$title, "creator_id"=>$creatorID, "content"=>$content, "summary"=>$summary, "tags"=>$tags, "online"=>$online));
    }

    function deleteProject(int $projectId){
        $this->delete((int)$projectId);
        $this->Comments->deleteCommentsByProject((int)$projectId);
    }

    /** titleTest:
    *Check if the project whith title exist
    *return: True -> if the title is used
    *        False -> if the title is not used. */
    public function titleTest($title){
        $title = htmlspecialchars($title);
        $reqTitleTest = $this->findFirst(array("conditions"=>"`title` = '$title'"));
        if (!$reqTitleTest) {
            return false;
        }else{
            return true;
        }
    }

    public function setProject(int $projectId, string $fieldName, $newValue){
        $newValue = htmlspecialchars($newValue);
        $projectId = (int)$projectId;
        $projectInfo = $this->getProject($projectId);
        $this->save(array("ID"=>$projectId, $fieldName=>$newValue, "publication_date"=>$projectInfo['publication_date']));
    }

}
?>
