<?php
require_once 'AppController.php';
require_once __DIR__.'/../models/ExerciseModel.php';
require_once __DIR__.'/../repositories/ExerciseRepository.php';
class AdminController extends AppController
{
    private $exerciseRepository;

    public function __construct()
    {
        parent::__construct();
        $this-> exerciseRepository = new ExerciseRepository();
    }
    public function adminPanel(){
        $this->render('adminpanel');
    }


    public function uploadExercise(){
        session_start();
        if ($this->isPost()) {
            if (isset($_COOKIE["privileges"]) && $_COOKIE["privileges"]==='1'){
                $exercise= new ExerciseModel(0,$_POST['exercise']);
                //$exercise->setExerciseName($_POST['exercise']);
                if($this->exerciseRepository->UploadExercise($exercise)){
                    return $this->render('adminpanel', ['success' => 'Exercise uploaded!']);
                }
            }
        }
        return $this->render('adminpanel', ['error' => 'Error!']);



    }

}