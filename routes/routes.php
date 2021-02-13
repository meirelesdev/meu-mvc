<?php

$this->get("/login", "LoginController@index");

$this->post("/login", "LoginController@login");
$this->get("/home", "HomeController@index");


$this->get("/apartamentos", "HomeController@listar");

$this->get("/logout", "LoginController@logout");

// $this->get("", function(){
//     echo "função";
//     exit;
// });
// $this->loadRouteFile('admin');

?>