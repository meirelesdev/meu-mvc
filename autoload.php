<?php
require_once 'vendor/autoload.php';
require_once 'config.php';


spl_autoload_register(function($class){
    if ( file_exists('Models'.DIRECTORY_SEPARATOR.$class.DIRECTORY_SEPARATOR.$class.'.php') ) {
        require_once 'Models'.DIRECTORY_SEPARATOR.$class.DIRECTORY_SEPARATOR.$class.'.php';
    } else if( file_exists('Controllers'.DIRECTORY_SEPARATOR.$class.DIRECTORY_SEPARATOR.$class.'.php')){
        require_once 'Controllers'.DIRECTORY_SEPARATOR.$class.DIRECTORY_SEPARATOR.$class.'.php';
    } else if( file_exists('Helpers'.DIRECTORY_SEPARATOR.$class.'.php')){
        require_once 'Helpers'.DIRECTORY_SEPARATOR.$class.'.php';
    } 
});
?>