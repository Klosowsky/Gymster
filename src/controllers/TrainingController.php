<?php

require_once 'AppController.php';

require_once 'src/builders/TrainingDayBuilder.php';
require_once 'src/builders/TrainingBuilder.php';
require_once 'src/models/ExerciseSetModel.php';
require_once 'src/repositories/TrainingRepository.php';
require_once 'src/repositories/ExerciseRepository.php';

class TrainingController extends AppController
{

    public function getTraining($test){
        //die("test ".$test);
        $trainingRepo = new TrainingRepository();
        $result=$trainingRepo->getTrainings();
        foreach ($result as $training){
            $training->printTraining();
        }

    }

    public function trainings(){
        $trainingRepository = new TrainingRepository();
        $trainings=$trainingRepository->getTrainings();
        $this->render('trainings',['trainings'=>$trainings]);
    }

    public function addTraining(){
        //$db= new Database();

        $exerciseRepository = new ExerciseRepository();
        $exercises=$exerciseRepository->getExercisesFromDb();
        //print_r($exercises[0]);
        $this->render('addtraining', ['exercises'=>$exercises]);
    }

    public function trainingDetails($param){
        $trainingRepository = new TrainingRepository();
        $training=$trainingRepository->getTrainingWithDetails($param);
        //print_r($training);
        $this->render('trainingdetails',['training'=>$training]);
    }

    public function uploadtraining()
    {
        $TrainingData=$_POST;

        $trainingBuilder= new TrainingBuilder();
        $trainingDayBuilder = new TrainingDayBuilder();

        $training = null;
        $trainingDay=null;

        print_r($TrainingData);
        print("<br>");
        print("size: ".sizeof($TrainingData)."<br>");
        print("Training title: ".$TrainingData['trng-title']."<br>");
        print("Training desc: ".$TrainingData['trng-desc']."<br>");
        $trainingBuilder->addTrainingTitle($TrainingData['trng-title']);
        $trainingBuilder->addTrainingDescription($TrainingData['trng-desc']);
        $trainingBuilder->addTrainingUserId(3);   // HARDCODED - holded until sessions will be covered...
        for($i=1;$i<=sizeof($TrainingData)-2;$i++){
            print("Training day nr: ".$i."<br>");
            for($j=1;$j<=sizeof($TrainingData[$i]['exercise']);$j++){
                print("*Exercise* <br>");
                print("-- Exercise: ".$TrainingData[$i]['exercise'][$j]."<br>");
                print("-- Series: ".$TrainingData[$i]['series'][$j]."<br>");
                print("-- Reps: ".$TrainingData[$i]['reps'][$j]."<br>");
                $trainingDayBuilder->addExercise(new ExerciseSetModel($TrainingData[$i]['exercise'][$j],$TrainingData[$i]['series'][$j],$TrainingData[$i]['reps'][$j]));
            }
            $trainingDay=$trainingDayBuilder->build();
            $trainingBuilder->addTrainingDay($trainingDay);
        }

        $training = $trainingBuilder->build();
        $training->printTraining();

        print("<br>-------*----------<br>");

        $trainingRepository = new TrainingRepository();
        $trainingRepository->uploadTrainingToDb($training);




        /*foreach ($TrainingData as $trainingDayIndex => $trainingDayData){
            print("Training title: ".$trainingDayIndex."<br>");
            print("Training desc: ".$trainingDayIndex."<br>");
            print("Training day nr: ".$trainingDayIndex."<br>");
            for($i=1;$i<=sizeof($trainingDayData['exercise']);$i++){
                print("*Exercise* <br>");
                print("-- Exercise: ".$trainingDayData['exercise'][$i]."<br>");
                print("-- Series: ".$trainingDayData['series'][$i]."<br>");
                print("-- Repse: ".$trainingDayData['reps'][$i]."<br>");
                $trainingDayBuilder->addExercise(new ExerciseSetModel($trainingDayData['exercise'][$i],$trainingDayData['series'][$i],$trainingDayData['reps'][$i]));
            }
            $trainingDay=$trainingDayBuilder->build();
            $trainingBuilder->addTrainingDay($trainingDay);
        }

        $training = $trainingBuilder->build();

        $training->printTraining();*/

        print("<br>-----------------<br>");




    }

}