<?php

class Controller{

    public $template = "default";
    public $vars = array();

    public function loadModel($name){
        $ControllerName = $name."Manager";
        $file = ROOT.DS.'models'.DS.$ControllerName.'.php';
        require_once($file);
        if(!isset($this->$name)){
            $this->$name = new $ControllerName;
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
        $view = ROOT.DS."views".DS.$reposName.DS.$viewName.".php";
        extract($this->vars);
        ob_start();
        require_once($view);
        $contentForTemplate = ob_get_clean();
        require_once(ROOT.DS."views".DS."templates".DS.$this->template.".php");
    }
}