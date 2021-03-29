<?php

class LoginHandler{

    public static function verifyLogin() {       
        $core = Core::getInstance();
        $base_url = $core->getConfig("BASE_URL");
     
        if( !isset($_SESSION[User::SESSION])
            ||
            !$_SESSION[User::SESSION]
            ||
            !(int)$_SESSION[User::SESSION]['id_usuario'] > 0
            
        ) {
    
            header("Location: ".$base_url."/login");
            exit;
        }
        return $_SESSION[User::SESSION];
    }

    public static function login($login, $password){
        $user = User::getInstance();
        $database = Database::getInstance();
    }

    public static function logout(){
        $_SESSION[User::SESSION] = NULL;
    }
}
?>