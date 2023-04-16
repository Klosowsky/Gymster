<?php

require_once 'src/models/TrainingModel.php';
class TrainingBuilder
{
    private $trainingModel;

    public function __construct(){
        $this->reset();
    }

    public function reset(){
        $this->trainingModel= new TrainingModel();
    }

    public function addTrainingDay($trainingDay){
        $tmpTrainingDays=$this->trainingModel->getTrainingDays();
        $tmpTrainingDays[]=$trainingDay;
        $this->trainingModel->setTrainingDays($tmpTrainingDays);
    }

    public function build() : TrainingModel {
        $result = $this->trainingModel;
        $this->reset();
        return $result;
    }
}