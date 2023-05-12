<?php

require_once 'Repository.php';
require_once __DIR__.'/../../src/models/TrainingModel.php';
require_once __DIR__.'/../../src/models/TrainingDayModel.php';
require_once __DIR__.'/../../src/models/ExerciseSetModel.php';
require_once __DIR__.'/../../src/models/ExerciseModel.php';
require_once __DIR__.'/../../src/builders/TrainingBuilder.php';
require_once __DIR__.'/../../src/builders/TrainingDayBuilder.php';
class TrainingRepository extends Repository
{

    public function getTrainingsWithExercises() : array {
        $trainingsArray=[];
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM public.trainings');
            $stmt->execute();
            $trainingsFromDb=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $trainingBuilder = new TrainingBuilder();
            $trainingDayBuilder = new TrainingDayBuilder();
            foreach ($trainingsFromDb as $training){
                //print($exercise['id']." - ".$exercise['name']);
                $trainingBuilder->addTrainingUserId($training['user_id']);
                $trainingBuilder->addTrainingTitle($training['title']);
                $trainingBuilder->addTrainingDescription($training['description']);
                $tmpTrainingId=$training['training_id'];
                $trainingBuilder->addTrainingId($tmpTrainingId);
                $stmt = $this->database->connect()->prepare('SELECT * FROM public.training_days WHERE training_id= :training_id');
                $stmt->bindParam(':training_id', $tmpTrainingId, PDO::PARAM_INT);
                $stmt->execute();
                $trainingDays=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($trainingDays as $trainingDay) {
                    $trainingDayBuilder->addDayNumber($trainingDay['day_number']);
                    $tmpTrainingDayId=$trainingDay['training_day_id'];
                    $stmt = $this->database->connect()->prepare('SELECT * FROM public.training_sessions WHERE training_day_id= :trainingDayId');
                    $stmt->bindParam(':trainingDayId', $tmpTrainingDayId, PDO::PARAM_INT);
                    $stmt->execute();
                    $exerciseSets=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($exerciseSets as $exerciseSet){
                        $tmpExerciseId= $exerciseSet['exercise_id'];
                        $stmt = $this->database->connect()->prepare('SELECT * FROM public.exercises WHERE exercise_id= :exerciseId');
                        $stmt->bindParam(':exerciseId', $tmpExerciseId, PDO::PARAM_INT);
                        $stmt->execute();
                        $exercise=$stmt->fetch(PDO::FETCH_ASSOC);
                        $trainingDayBuilder->addExercise(new ExerciseSetModel(new ExerciseModel($exercise['exercise_id'],$exercise['name']),$exerciseSet['series'],$exerciseSet['reps']));
                    }
                    $tmpTrainingDay=$trainingDayBuilder->build();
                    $trainingBuilder->addTrainingDay($tmpTrainingDay);
                }
                $trainingsArray[]=$trainingBuilder->build();
            }

        }catch (Exception $ex){
            print($ex);
        }
        //print_r($trainingsArray);
        return $trainingsArray;
    }

    public function getTrainings() : array {
        $trainingsArray=[];
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM public.v_trainings');
            $stmt->execute();
            $trainingsFromDb = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $trainingBuilder = new TrainingBuilder();
            foreach ($trainingsFromDb as $training) {
                $trainingBuilder->addTrainingUserId($training['user_id']);
                $trainingBuilder->addTrainingTitle($training['title']);
                $trainingBuilder->addTrainingDescription($training['description']);
                $trainingBuilder->addTrainingId($training['training_id']);
                $trainingBuilder->addLikes($training['likes']);
                $trainingBuilder->addDislikes($training['dislikes']);
                $trainingBuilder->addUsername($training['username']);
                $trainingBuilder->addUserPhoto($training['image']);
                $trainingsArray[]=$trainingBuilder->build();
            }
        }catch(Exception $ex){
            print($ex);
        }

        return $trainingsArray;
    }

    public function getTrainingWithDetails($trainingId) : TrainingModel{
        $finalTraining= null;
        try {
            $trainingBuilder = new TrainingBuilder();
            $trainingDayBuilder = new TrainingDayBuilder();

            $stmt = $this->database->connect()->prepare('SELECT * FROM public.trainings WHERE training_id = :trainingId');
            $stmt->bindParam(':trainingId', $trainingId, PDO::PARAM_INT);
            $stmt->execute();
            $trainingFromDb=$stmt->fetch(PDO::FETCH_ASSOC);
            $trainingBuilder->addTrainingUserId($trainingFromDb['user_id']);
            $trainingBuilder->addTrainingTitle($trainingFromDb['title']);
            $trainingBuilder->addTrainingDescription($trainingFromDb['description']);
            $trainingBuilder->addLikes($trainingFromDb['likes']);
            $trainingBuilder->addDislikes($trainingFromDb['dislikes']);
            $tmpTrainingId=$trainingFromDb['training_id'];
            $trainingBuilder->addTrainingId($tmpTrainingId);

            $stmt = $this->database->connect()->prepare('SELECT * FROM public.v_user_data WHERE user_id = :user_id');
            $stmt->bindParam(':user_id', $trainingFromDb['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            $userFromDb=$stmt->fetch(PDO::FETCH_ASSOC);
            $trainingBuilder->addUsername($userFromDb['username']);
            $trainingBuilder->addUserPhoto($userFromDb['user_photo']);

            $stmt = $this->database->connect()->prepare('SELECT * FROM public.training_days WHERE training_id= :training_id');
            $stmt->bindParam(':training_id', $tmpTrainingId, PDO::PARAM_INT);
            $stmt->execute();
            $trainingDays=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($trainingDays as $trainingDay) {
                $trainingDayBuilder->addDayNumber($trainingDay['day_number']);
                $tmpTrainingDayId=$trainingDay['training_day_id'];
                $stmt = $this->database->connect()->prepare('SELECT * FROM public.training_sessions WHERE training_day_id= :trainingDayId');
                $stmt->bindParam(':trainingDayId', $tmpTrainingDayId, PDO::PARAM_INT);
                $stmt->execute();
                $exerciseSets=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($exerciseSets as $exerciseSet){
                    $tmpExerciseId= $exerciseSet['exercise_id'];
                    $stmt = $this->database->connect()->prepare('SELECT * FROM public.exercises WHERE exercise_id= :exerciseId');
                    $stmt->bindParam(':exerciseId', $tmpExerciseId, PDO::PARAM_INT);
                    $stmt->execute();
                    $exercise=$stmt->fetch(PDO::FETCH_ASSOC);
                    $trainingDayBuilder->addExercise(new ExerciseSetModel(new ExerciseModel($exercise['exercise_id'],$exercise['name']),$exerciseSet['series'],$exerciseSet['reps']));
                }
                $tmpTrainingDay=$trainingDayBuilder->build();
                $trainingBuilder->addTrainingDay($tmpTrainingDay);
            }
            $finalTraining=$trainingBuilder->build();
        }catch(Exception $ex){
            print($ex);
        }
        return $finalTraining;
    }


    public function uploadTrainingToDb(TrainingModel $training) : int{


        $pdo = $this->database->connect();
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare('INSERT INTO public.trainings(user_id, title, description) VALUES(?,?,?) RETURNING training_id');
            $stmt->execute([$training->getUserId(),$training->getTrainingTitle(),$training->getTrainingDescription()]);
            $trainingId = $stmt->fetch(PDO::FETCH_ASSOC)['training_id'];
            $trainingDaysArr = $training->getTrainingDays();
            foreach ($trainingDaysArr as $dayNumber => $trainingDay){
                $stmt = $pdo->prepare('INSERT INTO public.training_days(training_id, day_number) VALUES(?,?) RETURNING training_day_id');
                $stmt->execute([$trainingId,$dayNumber+1]);
                $trainingDayId = $stmt->fetch(PDO::FETCH_ASSOC)['training_day_id'];
                $exercisesOfDayArr = $trainingDay->getExercises();
                foreach ($exercisesOfDayArr as $exerciseSet) {

                    $stmt = $pdo->prepare('INSERT INTO public.training_sessions(training_day_id,exercise_id, series, reps) VALUES(?,?,?,?) RETURNING training_day_id');
                    $stmt->execute([$trainingDayId,$exerciseSet->getExercise(),$exerciseSet->getSeries(),$exerciseSet->getReps()]); /////
                }
            }
            $pdo->commit();
            return $trainingId;
        }catch (Exception $ex){
            $pdo->rollBack();
            return -1;
        }

    }

    public function deleteTraining($trainingId) : bool{
        $con=$this->database->connect();
        try{
            $con->beginTransaction();
            $stmt = $con->prepare('DELETE FROM training_sessions WHERE training_day_id IN(SELECT training_day_id FROM training_days WHERE training_id= :training_id)');
            $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
            $stmt->execute();
            $stmt = $con->prepare('DELETE FROM training_days WHERE training_id= :training_id');
            $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
            $stmt->execute();
            $stmt = $con->prepare('DELETE FROM trainings WHERE training_id= :training_id');
            $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
            $stmt->execute();
            $stmt = $con->prepare('DELETE FROM user_ratings WHERE training_id= :training_id');
            $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
            $stmt->execute();

            $con->commit();
            return true;
        }catch(Exception $exc){
            $con->rollBack();
            print_r($exc);
            return false;
        }
    }

    public function setLike($trainingId,$userId){
        $con=$this->database->connect();
        try {
            $con->beginTransaction();
            $stmt = $con->prepare('SELECT rating FROM user_ratings r WHERE training_id= :training_id AND user_id= :user_id');
            $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $counter=$stmt->fetch(PDO::FETCH_ASSOC);
            if($counter['rating']===-1){
                $stmt = $con->prepare('UPDATE public.trainings SET "likes" = "likes" + 1 WHERE training_id = :training_id');
                $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
                $stmt->execute();
                $stmt = $con->prepare('UPDATE public.trainings SET "dislikes" = "dislikes" - 1 WHERE training_id = :training_id');
                $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
                $stmt->execute();
                $stmt = $con->prepare('UPDATE public.user_ratings SET rating=1 WHERE training_id= :training_id AND user_id= :user_id');
                $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $stmt->execute();
            }
            else if($counter['rating']===null){
                $stmt = $con->prepare('UPDATE public.trainings SET "likes" = "likes" + 1 WHERE training_id = :training_id');
                $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
                $stmt->execute();
                $stmt = $con->prepare('INSERT INTO public.user_ratings(user_id,training_id,rating) VALUES(:user_id,:training_id,1)');
                $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $stmt->execute();
            }
            else if($counter['rating']===1){
                $stmt = $con->prepare('UPDATE public.trainings SET "likes" = "likes" - 1 WHERE training_id = :training_id');
                $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
                $stmt->execute();
                $stmt = $con->prepare('DELETE FROM public.user_ratings WHERE user_id= :user_id  AND training_id = :training_id');
                $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $stmt->execute();
            }
            $con->commit();

        }catch (Exception $exc){
            $con->rollBack();
        }
    }

    public function getLikes($trainingId) {
        $stmt = $this->database->connect()->prepare('SELECT * FROM public.v_trainings WHERE training_id= :training_id');
        $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
        $stmt->execute();
        $likes=$stmt->fetch(PDO::FETCH_ASSOC);
        return $likes["likes"];
    }

    public function isLiked($trainingId,$userId) : bool{
        $stmt = $this->database->connect()->prepare('SELECT rating FROM user_ratings r WHERE training_id= :training_id AND user_id= :user_id');
        $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $likeState=$stmt->fetch(PDO::FETCH_ASSOC);
        return $likeState['rating']===1;
    }

    public function setDislike($trainingId,$userId){
        $con=$this->database->connect();
        try {
            $con->beginTransaction();
            $stmt = $con->prepare('SELECT rating FROM user_ratings r WHERE training_id= :training_id AND user_id= :user_id');
            $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $counter=$stmt->fetch(PDO::FETCH_ASSOC);
            if($counter['rating']===1){
                $stmt = $con->prepare('UPDATE public.trainings SET "dislikes" = "dislikes" + 1 WHERE training_id = :training_id');
                $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
                $stmt->execute();
                $stmt = $con->prepare('UPDATE public.trainings SET "likes" = "likes" - 1 WHERE training_id = :training_id');
                $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
                $stmt->execute();
                $stmt = $con->prepare('UPDATE public.user_ratings SET rating=-1 WHERE training_id= :training_id AND user_id= :user_id');
                $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $stmt->execute();
            }
            else if($counter['rating']===null){
                $stmt = $con->prepare('UPDATE public.trainings SET "dislikes" = "dislikes" + 1 WHERE training_id = :training_id');
                $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
                $stmt->execute();
                $stmt = $con->prepare('INSERT INTO public.user_ratings(user_id,training_id,rating) VALUES(:user_id,:training_id,-1)');
                $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $stmt->execute();
            }
            else if($counter['rating']===-1){
                $stmt = $con->prepare('UPDATE public.trainings SET "dislikes" = "dislikes" - 1 WHERE training_id = :training_id');
                $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
                $stmt->execute();
                $stmt = $con->prepare('DELETE FROM public.user_ratings WHERE user_id= :user_id  AND training_id = :training_id');
                $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $stmt->execute();
            }
            $con->commit();
        }catch (Exception $exc){
            $con->rollBack();
        }
    }

    function getDislikes($trainingId){
        $stmt = $this->database->connect()->prepare('SELECT dislikes FROM v_trainings WHERE training_id= :training_id');
        $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
        $stmt->execute();
        $likes=$stmt->fetch(PDO::FETCH_ASSOC);
        return $likes["dislikes"];
    }

    function isDisliked($trainingId,$userId) : bool{
        $stmt = $this->database->connect()->prepare('SELECT rating FROM user_ratings r WHERE training_id= :training_id AND user_id= :user_id');
        $stmt->bindParam(':training_id', $trainingId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $likeState=$stmt->fetch(PDO::FETCH_ASSOC);
        return $likeState['rating']===-1;
    }

    public function getTrainingsByTitle($trainingTitle) : array {
        $trainingsArray=[];
        try {
            $trainingTitle="%".$trainingTitle."%";
            $stmt = $this->database->connect()->prepare('SELECT * FROM public.v_trainings WHERE title LIKE(:title)');
            $stmt->bindParam(':title', $trainingTitle, PDO::PARAM_STR);
            $stmt->execute();
            $trainingsFromDb = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $trainingsFromDb;
            /*$trainingBuilder = new TrainingBuilder();
            foreach ($trainingsFromDb as $training) {
                $trainingBuilder->addTrainingUserId($training['user_id']);
                $trainingBuilder->addTrainingTitle($training['title']);
                $trainingBuilder->addTrainingDescription($training['description']);
                $trainingBuilder->addTrainingId($training['training_id']);
                $trainingBuilder->addLikes($training['likes']);
                $trainingBuilder->addDislikes($training['dislikes']);
                $trainingBuilder->addUsername($training['username']);
                $trainingBuilder->addUserPhoto($training['image']);
                $trainingsArray[]=$trainingBuilder->build();
            }*/
        }catch(Exception $ex){
            print($ex);
            return [];
        }

    }

}