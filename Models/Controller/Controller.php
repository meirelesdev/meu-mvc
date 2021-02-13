<?php

class Controller
{
    public $base_url;

    public function __construct(){
        $core = Core::getInstance();       
        $this->base_url = $core->getConfig('BASE_URL');
    }

    protected function redirect($url) {
        header("Location: ".$this->base_url.$url);
        exit;
    }

    private function _render($folder, $viewName, $viewData = []) {
      
        if(file_exists('views'.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$viewName.'.php')) {
            extract($viewData);
            $render = function($vN, $vD = []){
                $this->renderPartial($vN, $vD);
            };
            $base = $this->base_url;
            require 'views'.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$viewName.'.php';
        }
    }

    private function renderPartial($viewName, $viewData = []) {
        $this->_render('partials', $viewName, $viewData);
    }

    public function render($viewName, $viewData = []) {
        
        $this->_render('pages', $viewName, $viewData);
    }

}

?>