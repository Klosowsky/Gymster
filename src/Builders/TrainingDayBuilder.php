<?php


require_once 'src/models/TrainingDayModel.php';

class TrainingDayBuilder
{
    private $trainingDay;


    public function __construct(){
        $this->reset();
    }

    public function reset(){
        $this->trainingDay=new TrainingDayModel();
    }

    public function addExercise($exerciseSet){
        $tmpExercises=$this->trainingDay->getExercises();
        $tmpExercises[]=$exerciseSet;
        $this->trainingDay->setExercises($tmpExercises);
    }
    public function addDayNumber($dayNumber){
        $this->trainingDay->setDayNumber($dayNumber);
    }

    public function build() : TrainingDayModel {
        $result = $this->trainingDay;
        $this->reset();
        return $result;
    }
}