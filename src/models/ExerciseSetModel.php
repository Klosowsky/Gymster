<?php

class ExerciseSetModel
{
    private $exercise;
    private $series;
    private $reps;

    public function __construct($exercise, $series, $reps)
    {
        $this->exercise = $exercise;
        $this->series = $series;
        $this->reps = $reps;
    }


    public function getExercise()
    {
        return $this->exercise;
    }

    public function setExercise($exercise)
    {
        $this->exercise = $exercise;
    }


    public function getSeries()
    {
        return $this->series;
    }


    public function setSeries($series)
    {
        $this->series = $series;
    }


    public function getReps()
    {
        return $this->reps;
    }


    public function setReps($reps)
    {
        $this->reps = $reps;
    }


}