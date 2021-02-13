<?php


class User extends Model{

    const SESSION = "User";

    public function __construct( ) {
        parent::__construct();
    }

    public static function getInstance(){
        static $inst = null;
        if($inst === null){
            $inst = new User();
        }
        return $inst;
    }
    
}

?>