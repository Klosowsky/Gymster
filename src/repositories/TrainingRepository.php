<?php

require_once 'Repository.php';

class TrainingRepository extends Repository
{

    public function uploadTrainingToDb(){
        $stmt = $this->database->connect()->prepare('SELECT * FROM public.exercises');
        $stmt->execute();
        print('tu ok , ');
        $test = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r($test);
    }

}