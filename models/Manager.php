<?php
require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."conf.php");
require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."controllers".DIRECTORY_SEPARATOR."php".DIRECTORY_SEPARATOR."Parsedown.php");


/**
 * Model which going to be extended in all managers
 */
class Model { 

    public $Parsedown = false;  
    public $database_name = "default";
    public $db = false;
    public $table = "";

    public function __construct(){
        $Parsedown = new Parsedown;
        $Parsedown->setSafeMode(true);

        $this->Parsedown = $Parsedown;

        $conf = databases[$this->database_name];
        if(!$this->db){
            try {
                $pdo = new PDO("mysql:host=".$conf['host'].";dbname=".$conf['database'].";charset=utf8", $conf["login"], $conf['password']);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db = $pdo;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

    }

    public function find($req){
        $sql = "SELECT ";
        if(isset($req["selection"])){
            $sql .= $req["selection"];
        }else{
            $sql .= "* FROM ".$this->table;
        }
        if(isset($req["conditions"])){
            $sql .= " WHERE ".$req["conditions"];
        }if(isset($req["order"])){
            $order = $req["order"];
            $sql .= " ORDER BY $order";
        }if(isset($req["limit"])){
            $limit = $req["limit"];
            $sql .= " LIMIT $limit";
        }
        $pre = $this->db->prepare($sql);
        $pre->execute();
        $fetch = $pre->fetchAll();
        $pre->closeCursor();
        return $fetch;
    }

    public function findFirst($req){
        return current($this->find($req));
    }

    public function save(array $data){
        if(isset($data['ID'])){
            $sql = "UPDATE ".$this->table." SET ";
            foreach($data as $k=>$v){
                if($k !== 'ID'){
                    if(is_string($v)){
                        $sql .= "`$k`='$v',";
                    }else{
                        $sql .= "`$k`=$v,";
                    }
                    
                }
            }
            $sql = substr($sql, 0, -1);
            $sql .= " WHERE ID=".$data['ID'];

        }else{
            $sql = "INSERT INTO ".$this->table . " (";
            foreach($data as $k=>$v){
                $sql .= "`$k`,";
            }
            $sql = substr($sql, 0, -1);
            $sql .= ") VALUES(";
            foreach($data as $v){
                if(is_string($v)){
                    $sql .= "'$v', ";
                }else{
                    $sql .= "$v, ";
                }
            }
            $sql = substr($sql, 0, -2);
            $sql .= ")";
        }
        
        $pre = $this->db->prepare($sql);
        $pre->execute();
        $pre->closeCursor();
    }

    public function delete($cond){
        $sql = "DELETE FROM ".$this->table." WHERE ";
        if(is_numeric($cond)){
            $ID = (int)$cond;
            $sql .= "ID=$ID";
        }else{
            foreach($cond as $k=>$v){
                $sql .= "`$k`=$v AND ";
            }
            $sql = substr($sql, 0, -4);
        }
        $pre = $this->db->prepare($sql);
        $pre->execute();
        $pre->closeCursor();
    }
}