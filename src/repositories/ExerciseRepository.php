<?php
require_once 'Repository.php';
require_once __DIR__.'/../../src/models/ExerciseModel.php';
class ExerciseRepository extends Repository
{
    public function getExercisesFromDb() : array
    {
        $exercises =[];
        $stmt = $this->database->connect()->prepare('SELECT * FROM exercises');
        $stmt->execute();
        $exercisesFromDb = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($exercisesFromDb as $exercise){
            //print($exercise['id']." - ".$exercise['name']);
            $exercises[]= new ExerciseModel($exercise['exercise_id'],$exercise['name']);
        }
        return $exercises;
    }

    public function UploadExercise($exercise) :bool{
        try{
            $stmt = $this->database->connect()->prepare('INSERT INTO public.exercises (name) VALUES (?)');
            $stmt->execute([$exercise->getExerciseName()]);
            return true;
        }catch(Exception $exc){
            return false;
        }
    }
}