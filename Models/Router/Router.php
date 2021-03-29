<?php

class Router {

    private $get = [];
    private $post = [];

    private function __construct( ) { }

    public static function getInstance(){
        static $inst = null;
        if($inst === null){
            $inst = new Router();
        }
        return $inst;
    }
    public function checkRouter($method, $url) {
        $type = '';
        switch($method){
            case 'get':
                    $type = $this->get;
                break;
            case 'post':
                    $type = $this->post;
                break;
        }
        $err404 = false;
        foreach($type as $pt => $function){
            $pattern = preg_replace('(\{[a-z0-9]{0,}\})', '([a-z0-9]{0,})', $pt);
            
            if( preg_match('#^('.$pattern.')*$#i', $url, $matches )  ){
                array_shift($matches);
                array_shift($matches);
                $itens = [];
                if(preg_match_all('(\{[a-z0-9]{0,}\})', $pt, $m) ) {
                    $itens = preg_replace('(\{|\})', '', $m[0]);
                }
                $args = [];
                foreach($matches as $key => $match) {
                    $args[$itens[$key]] = $match;
                }
                if(gettype($function) == 'string'){
                    $func = explode("@", $function);
                    $controller = $func[0];
                    $action = $func[1];
                } else {
                    $action = $function;
                    $action($args);
                    break;
                }
                $controller = new $controller();
                call_user_func_array( [ $controller, $action], $args);
                $err404 = true;
                break;
            }
        }
        if(!$err404){
            $notFound = new NotfoundController();
            $notFound->index();
        }

    }

    public function load() {
        $this->loadRouteFile('routes');
        return $this;
    }

    public function loadRouteFile($f) {
        if(file_exists('routes'.DIRECTORY_SEPARATOR.$f.'.php')) {
            require_once 'routes'.DIRECTORY_SEPARATOR.$f.'.php';
        }
    }

    public function get($pattern, $function){
        $first = substr($pattern, 0, 1);
        if($first == '/'){
            $pattern = substr($pattern, 1);
        }
        $this->get[$pattern] = $function;
    }
    public function post($pattern, $function) {
        $first = substr($pattern, 0, 1);
        if($first == '/'){
            $pattern = substr($pattern, 1);
        }
        $this->post[$pattern] = $function;
    }

}
?>
