<?php
require('models/Manager.php');
/**
 * Model to manage projects.
 */
class ProjectsManager extends Manager
{
    public function getProjects(){
        $db = this->dbConnect();
        $req_projects = $db->query('SELECT p.ID ID, u.username creator, p.title title, p.summary summary, DATE_FORMAT(publication_date, \'%d/%m/%Y à %Hh%imin\') AS date_fr, tags FROM projects p INNER JOIN users u ON u.ID = p.creator_id');
        $projects =$req_projects->fetch();   
        $req_projects->closeCursor();
        return $projects; 
    }
    public function getProject($project_id){
        $project_id = (int)$project_id;
        $db = this->dbConnect();
        $req_project = $db->prepare('SELECT p.ID ID, u.username creator, p.title title, p.content content,  DATE_FORMAT(publication_date, \'%d/%m/%Y à %Hh%imin\') AS date_fr, tags FROM projects p INNER JOIN users u ON u.ID = p.creator_id WHERE ID=? ');
        $req_project->execute(array($project_id));
        $project =$req_project->fetch(); 
        $req_project->closeCursor();  
        return $project; 
    }
    public function createProject($title, $creator, $content, $summary, $tags){
        $title = htmlspecialchars($title);
        $creator = (int)$creator;
        $content = htmlspecialchars($content);
        $summary = htmlspecialchars($summary);
        $tags = htmlspecialchars($tags);
        $db = this->dbConnect();
        $req_project = $db->prepare('INSERT INTO projects (title, creator, content, summary, tags) VALUES(?, ?, ?, ?, ?)');
        $req_project->execute(array($title, $creator, $content, $summary, $tags));
        $req_project->closeCursor();
    }

}
?>
