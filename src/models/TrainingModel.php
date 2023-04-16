<?php

class TrainingModel
{
    private $trainingDays = [];

    public function getTrainingDays(): array
    {
        return $this->trainingDays;
    }

    public function setTrainingDays(array $trainingDays)
    {
        $this->trainingDays = $trainingDays;
    }

    public function printTraining()  {
        /*echo "Training: ".implode(" , " ,$this->trainingDays)." \n";*/
        echo '<pre>'; print_r($this->trainingDays); echo '</pre>';
    }

}