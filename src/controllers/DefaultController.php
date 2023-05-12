<?php


require_once 'AppController.php';
//require_once __DIR__.'/../../Database.php'; //tmp przenieść do proj controler

class DefaultController extends AppController
{

    public function index()
    {
        if (isset($_COOKIE["userId"]) OR isset($_COOKIE["username"]) OR isset($_COOKIE["privileges"])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/trainings");
        }
        else{
            return $this->render('login');
        }
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

    public function adminPanel(){
        $this->render('adminpanel');
    }

}