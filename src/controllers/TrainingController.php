<?php

require_once 'AppController.php';

require_once 'src/builders/TrainingDayBuilder.php';
require_once 'src/builders/TrainingBuilder.php';
require_once 'src/models/ExerciseSetModel.php';
require_once 'src/repositories/TrainingRepository.php';
require_once 'src/repositories/ExerciseRepository.php';

class TrainingController extends AppController
{

    private $trainingRepository;
    private $exerciseRepository;

    public function __construct()
    {
        parent::__construct();
        $this->trainingRepository = new TrainingRepository();
        $this->exerciseRepository = new ExerciseRepository();
    }

    public function getTraining($test){
        $result=$this->trainingRepository->getTrainings();
        foreach ($result as $training){
            $training->printTraining();
        }

    }

    public function trainings(){
        $trainings=$this->trainingRepository->getTrainings();
        $this->render('trainings',['trainings'=>$trainings]);
    }

    public function addTraining(){
        $exercises=$this->exerciseRepository->getExercisesFromDb();
        $this->render('addtraining', ['exercises'=>$exercises]);
    }

    public function trainingDetails($trainingId){
        $training=$this->trainingRepository->getTrainingWithDetails($trainingId);
        $this->render('trainingdetails',['training'=>$training]);
    }

    public function uploadtraining()
    {
        session_start();
        $TrainingData=$_POST;

        $trainingBuilder= new TrainingBuilder();
        $trainingDayBuilder = new TrainingDayBuilder();

        $training = null;
        $trainingDay=null;


        $trainingBuilder->addTrainingTitle($TrainingData['trng-title']);
        $trainingBuilder->addTrainingDescription($TrainingData['trng-desc']);
        $trainingBuilder->addTrainingUserId($_COOKIE["userId"]);
        $countOfDays=sizeof($TrainingData)-2;
        //print("general data size: ".$countOfDays);
        for($i=1;$i<=$countOfDays;$i++){
            //print("general data size: ".$countOfDays);
            //print($i."\n");
            //print_r($TrainingData[$i]['exercise']);
            if(is_subclass_of($TrainingData[$i]['exercise'],'Countable') || is_array($TrainingData[$i]['exercise'])){
                for ($j = 1; $j <= sizeof($TrainingData[$i]['exercise']); $j++) {
                    //print(" insidefor ");
                    $trainingDayBuilder->addExercise(new ExerciseSetModel($TrainingData[$i]['exercise'][$j], $TrainingData[$i]['series'][$j], $TrainingData[$i]['reps'][$j]));
                }
            }
            else{
                $countOfDays++;
            }
            $trainingDay=$trainingDayBuilder->build();
            $trainingBuilder->addTrainingDay($trainingDay);
        }

        $training = $trainingBuilder->build();
        $training->printTraining();


        $trainingId = $this->trainingRepository->uploadTrainingToDb($training);

        if($trainingId!==-1){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/trainingdetails/{$trainingId}");
        }
        else{
            return $this->render('addtraining'); // Error handling to add
        }

    }


    public function deleteTraining($trainingId){
        if($this->trainingRepository->deleteTraining($trainingId)) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/trainings");
        }
    }

    public function setLike($trainingId,$userId){
        $this->trainingRepository->setLike($trainingId,$userId);
        $resultArray= ['likes'=>$this->trainingRepository->getLikes($trainingId),'dislikes'=>$this->trainingRepository->getDislikes($trainingId),
            'isLiked'=>$this->trainingRepository->isLiked($trainingId,$userId),'isDisliked'=>$this->trainingRepository->isDisliked($trainingId,$userId)];
        echo json_encode($resultArray);
    }

    public function setDislike($trainingId,$userId){
        $this->trainingRepository->setDislike($trainingId,$userId);
        $resultArray= ['likes'=>$this->trainingRepository->getLikes($trainingId),'dislikes'=>$this->trainingRepository->getDislikes($trainingId),
            'isLiked'=>$this->trainingRepository->isLiked($trainingId,$userId),'isDisliked'=>$this->trainingRepository->isDisliked($trainingId,$userId)];

        echo json_encode($resultArray);
    }

    public function getRatings($trainingId,$userId){
        $resultArray= ['isLiked'=>$this->trainingRepository->isLiked($trainingId,$userId),'isDisliked'=>$this->trainingRepository->isDisliked($trainingId,$userId)];
        echo json_encode($resultArray);
    }

    public function search()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->trainingRepository->getTrainingsByTitle($decoded['search']));
        }
    }

}