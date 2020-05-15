<?php

require_once(ROOT."/controllers/php/functions.php");

class Controller{

    public $template = "default";
    public $vars = array();

    public function loadModel($name){
        $ModelName = $name."Manager";
        $file = ROOT.DS.'models'.DS.$ModelName.'.php';
        require_once($file);
        if(!isset($this->$name)){
            $this->$name = new $ModelName;
        }

    }

    public function setVariables($key, $value=null){
        if(is_array($key)){
            $this->vars += $key;
        }else{
            $this->vars[$key] = $value;
        }
    }

    public function render(string $reposName, string $viewName){
        if($reposName){
            $view = ROOT.DS."views".DS.$reposName.DS.$viewName.".php";
        }else{
            $view = ROOT.DS."views".DS.$viewName.".php";
        }

        extract($this->vars);
        ob_start();
        require_once($view);
        $contentForTemplate = ob_get_clean();
        $date = getTheDate();
        require_once(ROOT.DS."views".DS."templates".DS.$this->template.".php");
    }
}