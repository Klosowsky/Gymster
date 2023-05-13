<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/trainings.css">
    <link rel="icon" type="image/x-icon" href="/public/img/tab_logo.png">
    <meta charset="UTF-8">

    <title>Gymster</title>

    <script type="text/javascript" src="/public/js/ratings.js" defer></script>
    <script src="https://kit.fontawesome.com/ab1fdc6776.js" crossorigin="anonymous"></script>

</head>
<body>

<?php include 'public/views/header.php';?>

<div class="training-details-container">
    <div class="training-general-info-container">
        <?php
        if(isset($training)){?>
        <div class="training-general-info" id="<?=$training->getTrainingId();?>">

            <div class="training-item-usr" >
                <?php
                session_start();
                if ((isset($_COOKIE["privileges"])&&$_COOKIE["privileges"]==='1')||(isset($_COOKIE["userId"])&&$_COOKIE["userId"]===strval($training->getUserId()))){
                    ?>
                    <i class="fa-solid fa-trash fa-2xl" onclick="location.href='/deletetraining/<?= $training->getTrainingId()?>';"></i>
                <?php }?>
            </div>
            <div class="training-item-title">
                    <?=$training->getTrainingTitle(); ?>
            </div>
            <div class="training-item-descr">
                <?=$training->getTrainingDescription();?>
            </div>
            <div class="training-item-rate">
                <div class="likes" onload="getRatings()">
                    <i class="fa-solid fa-thumbs-up fa-xl" style="font-weight: 150; letter-spacing: 5px"><?= $training->getLikes()?></i>
                </div>
                <div class="dislikes">
                    <i class="fa-solid fa-thumbs-down fa-xl" style="font-weight: 150; letter-spacing: 5px"><?= $training->getDislikes()?></i>
                </div>
            </div>
            <div class="training-photo-position">
                <div class="training-user-photo">
                    <img class="user-profile-img" src="../public/uploads/<?= $training->getUserPhoto() ?>">
                </div>
            </div>
            <div class="training-username"> <p><?= $training->getUsername() ?></p>
            </div>
        </div>
    </div>
    <div class="training-days-container">
        <?php
        $trainingDays=$training->getTrainingDays();
        foreach ($trainingDays as $trainingDay) :
            ?>
            <div class="training-day-box">
                <div class="training-box-day-number">
                    <p>Day <?=$trainingDay->getDayNumber()?></p>
                </div>
                <div class="training-box-exercise-list">
                    <?php $exercises=$trainingDay->getExercises();
                    foreach ($exercises as $exercise) :
                        ?>
                        <div class="training-box-exercise">
                            <p class="p-exercise-name"><?=$exercise->getExercise()->getExerciseName()?></p>
                            <p class="p-exercise-details"> <?=$exercise->getSeries()?> series</p>
                            <p class="p-exercise-details"> <?=$exercise->getReps()?> reps</p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; }?>
    </div>

</div>


</body>
</html>