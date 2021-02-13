<?php

$this->get("/", "HomeController@index");

$this->get("/login", "LoginController@index");
$this->post("/login", "LoginController@login");

/**
 * Usando um função na rota
 */

// $this->get("", function(){
//     echo "função";
//     exit;
// });

/**
 * Adicionando novos arquivos de rotas
 */

// $this->loadRouteFile('admin');

?>