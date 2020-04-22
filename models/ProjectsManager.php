<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/Manager.php');
require_once('CommentsManager.php');

$CommentsManager = new CommentsManager;

//TODO adapter le model.
/**
 * Model to manage projects.
 */
class ProjectsManager extends Model
{
    /**
     * Renvoie les differents projets.
     */
    public function getProjects($page, $perPage){
        $begin = ($page-1)*4;
        $req_projects = $this->db->query("SELECT p.ID ID, u.username creator, p.title title, p.summary summary, DATE_FORMAT(publication_date, '%d/%m/%Y à %Hh%imin') AS date_fr, tags FROM projects p INNER JOIN users u ON u.ID = p.creator_id ORDER BY publication_date DESC LIMIT $begin,$perPage");
        $projects = $req_projects->fetchAll();
        $req_projects->closeCursor();
        return $projects; 
    }

    /**
     * Renvoie les differents projets d'un utilisateur.
     * @param int $id ID de l'utilisateur
     * @return array $projects Projets de l'utilisateur
     */
    public function getProjectsByUser(int $id){
        $req_projects = $this->db->prepare("SELECT p.ID ID, p.creator_id, u.username creator, p.title title, p.summary summary, DATE_FORMAT(publication_date, '%d/%m/%Y à %Hh%imin') AS date_fr, tags FROM projects p INNER JOIN users u ON u.ID = p.creator_id WHERE p.creator_id=? ORDER BY publication_date DESC");
        $req_projects->execute(array($id));
        $projects = $req_projects->fetchAll();
        $req_projects->closeCursor();
        return $projects;
    }

    public function getProject($project_id){
        global $CommentsManager;
        $project_id = (int)$project_id;
        $req_project = $this->db->prepare('SELECT p.ID ID, u.username creator, p.creator_id creator_id, p.title title, p.content content, p.summary summary,  publication_date, DATE_FORMAT(publication_date, \'%d/%m/%Y à %Hh%imin\') AS date_fr,  tags FROM projects p INNER JOIN users u ON u.ID = p.creator_id WHERE p.ID=? ');
        $req_project->execute(array($project_id));
        $project =$req_project->fetch();    
        $project['comments'] =  $CommentsManager->getCommentsByProject($project_id); 
        $req_project->closeCursor();
        return $project; 
    }

    public function getProjectsNumber(){
        $req_number = $this->db->query("SELECT COUNT(ID) AS nbProjects FROM projects");
        $data = $req_number->fetch();
        $nbProjects = $data['nbProjects'];
        $req_number->closeCursor();
        return $nbProjects;
    }

    public function createProject(string $title, int $creator, string $content, string $summary, string $tags){
        $title = htmlspecialchars($title);
        $creator = (int)$creator;
        $req_project = $this->db->prepare('INSERT INTO projects (title, creator_id, content, summary, publication_date, tags) VALUES(?, ?, ?, ?, NOW(), ?)');
        $req_project->execute(array($title, $creator, $content, $summary, $tags));
        $req_project->closeCursor();
    }

    function deleteProject(int $id){
        $req_delete = $this->db->prepare("DELETE FROM projects WHERE ID=?");
        $req_delete->execute(array($id));
        $req_delete->closeCursor();
    }

    /** titleTest:
    *Check if the project whith title exist
    *return: True -> if the title is used
    *        False -> if the title is not used. */
    public function titleTest($title){
        $title = htmlspecialchars(strip_tags($title));
        $reqTitleTest = $this->db->prepare("SELECT * FROM projects WHERE `title`=?");
        $reqTitleTest->execute(array($title));
        $is_project_exist = $reqTitleTest->rowCount();
        if ($is_project_exist === 0) {
            $reqTitleTest->closeCursor();
            return false;
        }else{
            $reqTitleTest->closeCursor();
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
        $set_project = $this->db->prepare("UPDATE projects SET `title`=?, publication_date=? WHERE ID=?");
        $set_project->execute(array($new_value, $project_info['publication_date'], $project_id));
        $set_project->closeCursor();
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
?>
