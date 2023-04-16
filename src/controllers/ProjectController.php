<?php

require_once 'AppController.php';

require_once 'src/builders/TrainingDayBuilder.php';
require_once 'src/builders/TrainingBuilder.php';
require_once 'src/models/ExerciseSetModel.php';
require_once 'src/repositories/TrainingRepository.php';
class ProjectController
{

    public function uploadtraining()
    {
        $TrainingData=$_POST;

        $trainingBuilder= new TrainingBuilder();
        $trainingDayBuilder = new TrainingDayBuilder();

        $training = null;
        $trainingDay=null;

        print_r($TrainingData);
        print("<br>");

        foreach ($TrainingData as $trainingDayIndex => $trainingDayData){
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

        $training->printTraining();

        print("<br>-----------------<br>");

        $trainingRepository = new TrainingRepository();
        $trainingRepository->uploadTrainingToDb();


    }

}