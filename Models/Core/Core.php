<?php

class Core {

    private $config = [];

    private function __construct( ) { }

    public static function getInstance(){
        static $inst = null;
        if($inst === null){
            $inst = new Core();
        }
        return $inst;
    }

    public function start($config) {
        $this->config = $config;
        $router = $this->loadRouter();
        $url = isset($_GET['url']) ? $_GET['url'] : '';
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $router->checkRouter($method, $url);
    }

    public function getConfig($name){
        return $this->config[$name];
    }

    public function loadRouter(){
        $router = Router::getInstance();
        return $router->load();
    }
}
?>
