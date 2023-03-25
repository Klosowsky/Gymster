<?php


require_once 'AppController.php';

class DefaultController extends AppController
{

    public function index()
    {
        // TODO check sesion etc..
        $this->render('login');
    }

    public function register()
    {
        $this->render('register');
    }

    public function trainings()
    {
        $this->render('trainings');
    }

}