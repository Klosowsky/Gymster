<?php

class TrainingDayModel
{
    private $exercises = [];
    private $dayNumber;

    public function printAllExercises()  {
        echo "Exercises in this training day: ".implode(" , " ,$this->exercises)." \n";
    }

    public function getExercises(): array
    {
        return $this->exercises;
    }

    public function setExercises(array $exercises)
    {
        $this->exercises = $exercises;
    }

    public function getDayNumber()
    {
        return $this->dayNumber;
    }

    public function setDayNumber($dayNumber)
    {
        $this->dayNumber = $dayNumber;
    }



}