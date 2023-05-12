<?php

require_once 'Repository.php';
require_once __DIR__.'/../../src/models/TrainingModel.php';
require_once __DIR__.'/../../src/models/TrainingDayModel.php';
require_once __DIR__.'/../../src/models/ExerciseSetModel.php';
require_once __DIR__.'/../../src/models/ExerciseModel.php';
require_once __DIR__.'/../../src/builders/TrainingBuilder.php';
require_once __DIR__.'/../../src/builders/TrainingDayBuilder.php';
class TrainingRepository extends Repository
{

    public function getTrainingsWithExercises() : array {
        $trainingsArray=[];
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM public.trainings');
            $stmt->execute();
            $trainingsFromDb=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $trainingBuilder = new TrainingBuilder();
            $trainingDayBuilder = new TrainingDayBuilder();
            foreach ($trainingsFromDb as $training){
                //print($exercise['id']." - ".$exercise['name']);
                $trainingBuilder->addTrainingUserId($training['user_id']);
                $trainingBuilder->addTrainingTitle($training['title']);
                $trainingBuilder->addTrainingDescription($training['description']);
                $tmpTrainingId=$training['training_id'];
                $trainingBuilder->addTrainingId($tmpTrainingId);
                $stmt = $this->database->connect()->prepare('SELECT * FROM public.training_days WHERE training_id= :training_id');
                $stmt->bindParam(':training_id', $tmpTrainingId, PDO::PARAM_INT);
                $stmt->execute();
                $trainingDays=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($trainingDays as $trainingDay) {
                    $trainingDayBuilder->addDayNumber($trainingDay['day_number']);
                    $tmpTrainingDayId=$trainingDay['training_day_id'];
                    $stmt = $this->database->connect()->prepare('SELECT * FROM public.training_sessions WHERE training_day_id= :trainingDayId');
                    $stmt->bindParam(':trainingDayId', $tmpTrainingDayId, PDO::PARAM_INT);
                    $stmt->execute();
                    $exerciseSets=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($exerciseSets as $exerciseSet){
                        $tmpExerciseId= $exerciseSet['exercise_id'];
                        $stmt = $this->database->connect()->prepare('SELECT * FROM public.exercises WHERE exercise_id= :exerciseId');
                        $stmt->bindParam(':exerciseId', $tmpExerciseId, PDO::PARAM_INT);
                        $stmt->execute();
                        $exercise=$stmt->fetch(PDO::FETCH_ASSOC);
                        $trainingDayBuilder->addExercise(new ExerciseSetModel(new ExerciseModel($exercise['exercise_id'],$exercise['name']),$exerciseSet['series'],$exerciseSet['reps']));
                    }
                    $tmpTrainingDay=$trainingDayBuilder->build();
                    $trainingBuilder->addTrainingDay($tmpTrainingDay);
                }
                $trainingsArray[]=$trainingBuilder->build();
            }

        }catch (Exception $ex){
            print($ex);
        }
        //print_r($trainingsArray);
        return $trainingsArray;
    }

    public function getTrainings() : array {
        $trainingsArray=[];
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM public.v_trainings');
            $stmt->execute();
            $trainingsFromDb = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $trainingBuilder = new TrainingBuilder();
            foreach ($trainingsFromDb as $training) {
                $trainingBuilder->addTrainingUserId($training['user_id']);
                $trainingBuilder->addTrainingTitle($training['title']);
                $trainingBuilder->addTrainingDescription($training['description']);
                $trainingBuilder->addTrainingId($training['training_id']);
                $trainingBuilder->addLikes($training['likes']);
                $trainingBuilder->addDislikes($training['dislikes']);
                $trainingBuilder->addUsername($training['username']);
                $trainingsArray[]=$trainingBuilder->build();
            }
        }catch(Exception $ex){
            print($ex);
        }

        return $trainingsArray;
    }

    public function getTrainingWithDetails($trainingId) : TrainingModel{
        $finalTraining= null;
        try {
            $trainingBuilder = new TrainingBuilder();
            $trainingDayBuilder = new TrainingDayBuilder();

            $stmt = $this->database->connect()->prepare('SELECT * FROM public.trainings WHERE training_id = :trainingId');
            $stmt->bindParam(':trainingId', $trainingId, PDO::PARAM_INT);
            $stmt->execute();
            $trainingFromDb=$stmt->fetch(PDO::FETCH_ASSOC);
            $trainingBuilder->addTrainingUserId($trainingFromDb['user_id']);
            $trainingBuilder->addTrainingTitle($trainingFromDb['title']);
            $trainingBuilder->addTrainingDescription($trainingFromDb['description']);
            $trainingBuilder->addLikes($trainingFromDb['likes']);
            $trainingBuilder->addDislikes($trainingFromDb['dislikes']);
            $tmpTrainingId=$trainingFromDb['training_id'];
            $trainingBuilder->addTrainingId($tmpTrainingId);
            $stmt = $this->database->connect()->prepare('SELECT * FROM public.training_days WHERE training_id= :training_id');
            $stmt->bindParam(':training_id', $tmpTrainingId, PDO::PARAM_INT);
            $stmt->execute();
            $trainingDays=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($trainingDays as $trainingDay) {
                $trainingDayBuilder->addDayNumber($trainingDay['day_number']);
                $tmpTrainingDayId=$trainingDay['training_day_id'];
                $stmt = $this->database->connect()->prepare('SELECT * FROM public.training_sessions WHERE training_day_id= :trainingDayId');
                $stmt->bindParam(':trainingDayId', $tmpTrainingDayId, PDO::PARAM_INT);
                $stmt->execute();
                $exerciseSets=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($exerciseSets as $exerciseSet){
                    $tmpExerciseId= $exerciseSet['exercise_id'];
                    $stmt = $this->database->connect()->prepare('SELECT * FROM public.exercises WHERE exercise_id= :exerciseId');
                    $stmt->bindParam(':exerciseId', $tmpExerciseId, PDO::PARAM_INT);
                    $stmt->execute();
                    $exercise=$stmt->fetch(PDO::FETCH_ASSOC);
                    $trainingDayBuilder->addExercise(new ExerciseSetModel(new ExerciseModel($exercise['exercise_id'],$exercise['name']),$exerciseSet['series'],$exerciseSet['reps']));
                }
                $tmpTrainingDay=$trainingDayBuilder->build();
                $trainingBuilder->addTrainingDay($tmpTrainingDay);
            }
            $finalTraining=$trainingBuilder->build();
        }catch(Exception $ex){
            print($ex);
        }
        return $finalTraining;
    }


    public function uploadTrainingToDb(TrainingModel $training) : bool{


        $pdo = $this->database->connect();
        try {
            $pdo->beginTransaction();
            print("<br>Training:<br>");
            $stmt = $pdo->prepare('INSERT INTO public.trainings(user_id, title, description) VALUES(?,?,?) RETURNING training_id');
            $stmt->execute([$training->getUserId(),$training->getTrainingTitle(),$training->getTrainingDescription()]);
            $trainingId = $stmt->fetch(PDO::FETCH_ASSOC)['training_id'];
            $trainingDaysArr = $training->getTrainingDays();
            print("<br>");
            foreach ($trainingDaysArr as $dayNumber => $trainingDay){
                print("-Day ".$dayNumber."<br>");
                $stmt = $pdo->prepare('INSERT INTO public.training_days(training_id, day_number) VALUES(?,?) RETURNING training_day_id');
                $stmt->execute([$trainingId,$dayNumber+1]);
                $trainingDayId = $stmt->fetch(PDO::FETCH_ASSOC)['training_day_id'];
                $exercisesOfDayArr = $trainingDay->getExercises();
                foreach ($exercisesOfDayArr as $exerciseSet) {
                    print("-- Exercise: ".$exerciseSet->getExercise()."<br>");
                    print("-- Series: ".$exerciseSet->getSeries()."<br>");
                    print("-- Reps: ".$exerciseSet->getReps()."<br>");
                    $stmt = $pdo->prepare('INSERT INTO public.training_sessions(training_day_id,exercise_id, series, reps) VALUES(?,?,?,?) RETURNING training_day_id');
                    $stmt->execute([$trainingDayId,$exerciseSet->getExercise(),$exerciseSet->getSeries(),$exerciseSet->getReps()]); /////
                    print("-----<br>");
                }
                print("<br>");
            }
            $pdo->commit();
            return true;
        }catch (Exception $ex){
            print("<br>exception<br>");
            print($ex);
            $pdo->rollBack();
            return false;
        }
        //$test = $stmt->fetch(PDO::FETCH_ASSOC);
        //print_r($test);
    }


}