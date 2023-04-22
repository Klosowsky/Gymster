<?php

class ExerciseModel
{
    private $exerciseId;
    private $exerciseName;

    public function __construct($exerciseId, $exerciseName)
    {
        $this->exerciseId = $exerciseId;
        $this->exerciseName = $exerciseName;
    }

    public function getExerciseId()
    {
        return $this->exerciseId;
    }
    public function setExerciseId($exerciseId)
    {
        $this->exerciseId = $exerciseId;
    }
    public function getExerciseName()
    {
        return $this->exerciseName;
    }
    public function setExerciseName($exerciseName)
    {
        $this->exerciseName = $exerciseName;
    }
}