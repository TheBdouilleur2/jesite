<?php

class Controller{


    function loadModel($name){
        $file = ROOT.DS.'models'.DS.$name.'Manager.php';
        require_once($file);
        if(!isset($this->$name)){
            $this->$name = new $name;
        }

    }
}