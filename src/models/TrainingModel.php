<?php

class TrainingModel
{
    private $trainingDays = [];
    private $trainingTitle;
    private $trainingDescription;
    private $userId;
    private $username;
    private $userPhoto;
    private $trainingId;
    private $likes;
    private $dislikes;

    /**
     * @return mixed
     */
    public function getUserPhoto()
    {
        return $this->userPhoto;
    }

    /**
     * @param mixed $userPhoto
     */
    public function setUserPhoto($userPhoto): void
    {
        $this->userPhoto = $userPhoto;
    }


    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function getLikes()
    {
        return $this->likes;
    }

    public function setLikes($likes): void
    {
        $this->likes = $likes;
    }

    public function getDislikes()
    {
        return $this->dislikes;
    }

    public function setDislikes($dislikes): void
    {
        $this->dislikes = $dislikes;
    }


    public function getTrainingDays(): array
    {
        return $this->trainingDays;
    }

    public function setTrainingDays(array $trainingDays)
    {
        $this->trainingDays = $trainingDays;
    }

    public function getTrainingTitle()
    {
        return $this->trainingTitle;
    }

    public function setTrainingTitle($trainingTitle)
    {
        $this->trainingTitle = $trainingTitle;
    }

    public function getTrainingDescription()
    {
        return $this->trainingDescription;
    }

    public function setTrainingDescription($trainingDescription)
    {
        $this->trainingDescription = $trainingDescription;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getTrainingId()
    {
        return $this->trainingId;
    }

    public function setTrainingId($trainingId)
    {
        $this->trainingId = $trainingId;
    }




    public function printTraining()  {
        /*echo "Training: ".implode(" , " ,$this->trainingDays)." \n";*/
        //echo '<pre>'; print_r($this->trainingDays); echo '</pre>';
    }

}