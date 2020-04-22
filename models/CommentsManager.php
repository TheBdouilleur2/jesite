<?php
require_once(ROOT . DS.'models'.DS.'Manager.php');
require_once(ROOT.DS."controllers".DS."php".DS."functions.php");
/**
 * Permet de gerer les commentaires.
 */
class CommentsManager extends Model {

    public $table = "comment_projects";
    
    /**
     * Retourne les commentaires liés à un projet.
     * @param int $id L'ID du projet
     * @return array
     */
    public function getCommentsByProject(int $id){
        $comments = $this->find(array("conditions"=>"project_id = ".$id, "selection"=>"c.ID ID, u.username sender, c.sender_id sender_id, c.msg msg, c.publication_date publication_date FROM ".$this->table." c INNER JOIN users u ON u.ID = c.sender_id"));
        for ($i=0; $i < count($comments); $i++) { 
            $comments[$i]['age'] = getOld($comments[$i]["publication_date"]);
        }
        return $comments;
    }

}