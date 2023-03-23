<?php

require 'Routing.php';

$path= parse_url(trim($_SERVER['REQUEST_URI'],'/'), PHP_URL_PATH);

Routing::get('','DefaultController');
Routing::post('login','LoginController');
Routing::get('register','DefaultController');
Routing::get('projects','DefaultController');

Routing::run($path);

?>