<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/trainings.css">
    <style>body {background:lightcyan;}</style>
    <meta charset="UTF-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>Gymster</title>


<!--    <script>
        const likeButtons = document.querySelectorAll(".fa-thumbs-up");
        const dislikeButtons = document.querySelectorAll(".fa-minus-square");


        function giveLike() {

            const likes = this;
            const container = likes.parentElement.parentElement.parentElement;
            const id = container.getAttribute("id");
            console.log('like '+id);
            fetch(`/setlike/${id}/`)
                .then(function () {
                    likes.innerHTML = parseInt(likes.innerHTML) + 1;
                })
        }

        function giveDislike() {
            const dislikes = this;
            const container = dislikes.parentElement.parentElement.parentElement;
            const id = container.getAttribute("id");

            fetch(`/dislike/${id}`)
                .then(function () {
                    dislikes.innerHTML = parseInt(dislikes.innerHTML) + 1;
                })
        }

        likeButtons.forEach(button => button.addEventListener("click", giveLike));
        dislikeButtons.forEach(button => button.addEventListener("click", giveDislike));
    </script>-->
    <script type="text/javascript" src="/src/js/ratings.js" defer></script>
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
                    <i class="fa-solid fa-thumbs-up fa-2xl" style="font-weight: 150; letter-spacing: 5px"><?= $training->getLikes()?></i>
                </div>
                <div class="dislikes">
                    <i class="fa-solid fa-thumbs-down fa-2xl " style="font-weight: 150; letter-spacing: 5px"><?= $training->getDislikes()?></i>
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