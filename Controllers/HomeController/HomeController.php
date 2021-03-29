<?php 

class HomeController extends Controller {

    private $empreendimento;

    public function __construct() {   
        parent::__construct();
        $user = LoginHandler::verifyLogin();
       
    }

    public function index(){
        
    }

    public function listar(){

    }
}

?>
