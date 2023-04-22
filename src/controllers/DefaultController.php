<?php


require_once 'AppController.php';
//require_once __DIR__.'/../../Database.php'; //tmp przenieść do proj controler

class DefaultController extends AppController
{

    public function index()
    {
        // TODO check sesion etc..
        $this->render('login');
    }

/*    public function register()
    {
        $this->render('register');
    }*/

 /*   public function trainings()
    {

        $this->render('trainings');
    }*/

/*    public function trainingDetails(){
        $this->render('trainingdetails');
    }*/

    public function addTraining(){
        //$db= new Database();
        $exercises=["test_ex1","test","3test"];
        $this->render('addtraining', ['exercises'=>$exercises]);
    }

}