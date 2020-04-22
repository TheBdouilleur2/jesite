<?php
try{
    require_once(ROOT.DS."config".DS."conf.php");
} catch(Exception $e) {
    try{
        require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."conf.php");
    }catch(Exception $e){
        die($e->getMessage());
    }
}

/**
 * Model which going to be extended in all managers
 */
class Model {   
    public $database_name = "default";
    public $db = false;
    public $table = "";

    public function __construct(){
        global $databases;
        $conf = $databases[$this->database_name];
        if(!$this->db){
            try {
                $pdo = new PDO("mysql:host=".$conf['host'].";dbname=".$conf['database'].";charset=utf8", $conf["login"], $conf['password']);
                $this->db = $pdo;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

    }

    public function find($req){
        $sql = "SELECT ";
        if(isset($req['selection'])){
            $sql .= $req['selection'];
        }else{
            $sql .= "* FROM ".$this->table;
        }
        if(isset($req['conditions'])){
            $sql .= " WHERE ".$req['conditions'];
        }
        $pre = $this->db->prepare($sql);
        $pre->execute();
        return $pre->fetchAll();
    }

    public function findFirst($req){
        return current($this->find($req));
    }

    protected function dbConnect(){
        global $databases;
        $conf = $databases[$this->database_name];
        $db = new PDO("mysql:host=".$conf['host'].";dbname=".$conf['database'].";charset=utf8", $conf["login"], $conf['password']);
        return $db;
    }
}