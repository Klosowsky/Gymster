<?php

require 'Routing.php';

$path= parse_url(trim($_SERVER['REQUEST_URI'],'/'), PHP_URL_PATH);

Routing::get('','DefaultController');
Routing::get('userpanel','UserDetailsController');
Routing::post('login','SecurityController');
Routing::get('register','SecurityController'); // post??????????
Routing::get('logout','SecurityController');
//Routing::get('trainings','DefaultController');
//Routing::get('trainingdetails','DefaultController');
Routing::get('addtraining','TrainingController');
Routing::post('uploadtraining','TrainingController');
Routing::get('gettraining','TrainingController');
Routing::get('trainings','TrainingController');
Routing::post('trainingdetails','TrainingController');
Routing::post('setuserdetails','UserDetailsController');
Routing::get('adminpanel','AdminController');
Routing::post('uploadexercise','AdminController');
Routing::post('deletetraining','TrainingController');
Routing::post('setlike','TrainingController');
Routing::post('setdislike','TrainingController');
Routing::post('search','TrainingController');
Routing::post('getratings','TrainingController');

Routing::run($path);

?>