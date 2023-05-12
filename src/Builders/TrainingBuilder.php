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

    public function addTrainingTitle($trainingTitle){
        $this->trainingModel->setTrainingTitle($trainingTitle);
    }

    public function addTrainingDescription($trainingDesc){
        $this->trainingModel->setTrainingDescription($trainingDesc);
    }
    public function addTrainingUserId($trainingUserId){
        $this->trainingModel->setUserId($trainingUserId);
    }
    public function addTrainingId($trainingId){
        $this->trainingModel->setTrainingId($trainingId);
    }
    public function addLikes($likes){
        $this->trainingModel->setLikes($likes);
    }
    public function addDislikes($dislikes){
        $this->trainingModel->setDislikes($dislikes);
    }
    public function addUsername($username){
        $this->trainingModel->setUsername($username);
    }
    public function addUserPhoto($userPhoto){
        $this->trainingModel->setUserPhoto($userPhoto);
    }


    public function build() : TrainingModel {
        $result = $this->trainingModel;
        $this->reset();
        return $result;
    }
}