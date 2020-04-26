<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/Manager.php');
require_once('CommentsManager.php');

$CommentsManager = new CommentsManager;

/**
 * Model to manage projects.
 */
class ProjectsManager extends Model
{
    public $table = "projects";

    /**
     * Renvoie les differents projets.
     */
    public function getProjects($page, $perPage){
        $begin = ($page-1)*4;
        $projects = $this->find(array("selection"=>"p.ID ID, u.username creator, p.title title, p.summary summary, DATE_FORMAT(publication_date, '%d/%m/%Y à %Hh%imin') AS date_fr, tags FROM projects p INNER JOIN users u ON u.ID = p.creator_id", "order"=>"publication_date DESC", "limit"=>"$begin,$perPage"));
        for ($i=0; $i < count($projects); $i++) { 
            $projects[$i]["summary"] = $this->Parsedown->line($projects[$i]["summary"]);
            $projects[$i]["content"] = $this->Parsedown->text($projects[$i]["content"]);
        }
        return $projects; 
    }

    /**
     * Renvoie les differents projets d'un utilisateur.
     * @param int $id ID de l'utilisateur
     * @return array $projects Projets de l'utilisateur
     */
    public function getProjectsByUser(int $userId){
        $userId = (int)$userId;
        $projects = $this->find(array("selection"=>"p.ID ID, p.creator_id, u.username creator, p.title title, p.summary summary, DATE_FORMAT(publication_date, '%d/%m/%Y à %Hh%imin') AS date_fr, tags FROM projects p INNER JOIN users u ON u.ID = p.creator_id WHERE p.creator_id=$userId", "order"=>"publication_date DESC"));
        for ($i=0; $i < count($projects); $i++) { 
            $projects[$i]["summary"] = $this->Parsedown->line($projects[$i]["summary"]);
            $projects[$i]["content"] = $this->Parsedown->text($projects[$i]["content"]);
        }
        return $projects;
    }

    public function getProject($project_id){
        global $CommentsManager;
        $project_id = (int)$project_id;
        $project = $this->findFirst(array("selection"=>"p.ID ID, u.username creator, p.creator_id creator_id, p.title title, p.content content, p.summary summary,  publication_date, DATE_FORMAT(publication_date, '%d/%m/%Y à %Hh%imin') AS date_fr,  tags FROM projects p INNER JOIN users u ON u.ID = p.creator_id", "conditions"=>"p.ID=$project_id"));
        $project['comments'] =  $CommentsManager->getCommentsByProject($project_id); 
        $project['content'] = $this->Parsedown->text($project['content']);
        return $project; 
    }

    public function getProjectsNumber(){
        $data = $this->findFirst(array("selection"=>"COUNT(ID) AS nbProjects FROM projects"));
        $nbProjects = $data['nbProjects'];
        return $nbProjects;
    }

    public function createProject(string $title, int $creatorID, string $content, string $summary, string $tags){
        $title = htmlspecialchars($title);
        $creatorID = (int)$creatorID;
        $this->save(array("title"=>$title, "creator_id"=>$creatorID, "content"=>$content, "summary"=>$summary, "tags"=>$tags));
    }

    function deleteProject(int $projectId){
        global $CommentsManager;
        $this->delete((int)$projectId);
        $CommentsManager->deleteCommentsByProject((int)$projectId);
    }

    /** titleTest:
    *Check if the project whith title exist
    *return: True -> if the title is used
    *        False -> if the title is not used. */
    public function titleTest($title){
        $title = htmlspecialchars(strip_tags($title));
        $reqTitleTest = $this->findFirst(array("conditions"=>"`title` = '$title'"));
        if (!$reqTitleTest) {
            return false;
        }else{
            return true;
        }
    }

    /** setTitle:
    *Change a value of an paroject's title.
    *@params: int $project_id ID of the project 
    *         $new_value change value 
    */
    public function setTitle(int $project_id, $new_value){
        $new_value = htmlspecialchars(strip_tags($new_value));
        $project_info = $this->getProject($project_id);
        $set_project = $this->save(array("ID"=>$project_id, "title"=>$new_value, "publication_date"=>$project_info['publication_date']));
        //TODO utiliser une seule fonction.
    }

    /** setContent:
    *Change a value of an project's content.
    *params: - ID of the project 
    *        - change value 
    */
    public function setContent(int $project_id, $new_value){
        $new_value = htmlspecialchars(strip_tags($new_value));
        $set_project = $this->db->prepare("UPDATE projects SET `content`=? WHERE ID=?");
        $set_project->execute(array($new_value, $project_id));
        $set_project->closeCursor();
    }

    /** setSummary:
    *Change a value of an project's summary.
    *params: - ID of the project 
    *        - change value */
    public function setSummary(int $project_id, $new_value){
        $new_value = htmlspecialchars(strip_tags($new_value));
        $set_project = $this->db->prepare("UPDATE projects SET `summary`=? WHERE ID=?");
        $set_project->execute(array($new_value, $project_id));
        $set_project->closeCursor();
    }

    /** setTags:
    *Change a value of an project's tags.
    *params: - ID of the project 
    *       - change value */
    public function setTags(int $project_id, $new_value){
        $new_value = htmlspecialchars(strip_tags($new_value));
        $set_project = $this->db->prepare("UPDATE projects SET `tags`=? WHERE ID=?");
        $set_project->execute(array($new_value, $project_id));
        $set_project->closeCursor();
    }


}
//TODO ne pas changer la date de publication des projets
?>
