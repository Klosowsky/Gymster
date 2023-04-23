<?php

require 'Routing.php';

$path= parse_url(trim($_SERVER['REQUEST_URI'],'/'), PHP_URL_PATH);

Routing::get('','DefaultController');
Routing::get('userpanel','DefaultController');
Routing::post('login','SecurityController');
Routing::get('register','SecurityController');
Routing::get('logout','SecurityController');
//Routing::get('trainings','DefaultController');
//Routing::get('trainingdetails','DefaultController');
Routing::get('addtraining','TrainingController');
Routing::post('uploadtraining','TrainingController');
Routing::get('gettraining','TrainingController');
Routing::get('trainings','TrainingController');
Routing::post('trainingdetails','TrainingController');

Routing::run($path);

?>