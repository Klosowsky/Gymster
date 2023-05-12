<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/trainings.css">
    <link rel="icon" type="image/x-icon" href="/public/img/tab_logo.png">
    <meta charset="UTF-8">
    <title>Gymster</title>

    <script type="text/javascript" src="/public/js/search.js" defer></script>
    <script src="https://kit.fontawesome.com/ab1fdc6776.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include 'public/views/header.php';?>

<div class="main-container">
    <div class="main-tool-bar">
        <div class="search-training-bar">
            <input class="search-training-input" type="text" placeholder="Search...">
            <i class="fa-solid fa-magnifying-glass fa-2xl" onclick="fetchTrainings()"></i>
        </div>

        <div class="add-training-btn" onclick="location.href='/addtraining';" style="cursor: pointer;">
                <i class="fa-solid fa-plus fa-2xl"></i>
                <p class="p-add-workout">Add training</p>
        </div>

    </div>

    <div class="trainings-main-container">
        <section class="trainings-sec">
            <?php  if(isset($trainings)){ foreach($trainings as $training) :?>
            <a href="/trainingdetails/<?= $training->getTrainingId()?>">
            <div class="training-item">
                <div class="training-item-usr">
                    <?php
                    session_start();
                    if (isset($_COOKIE["userId"])&&$_COOKIE["userId"]===strval($training->getUserId())){
                    ?>

                        <i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i>
                    <?php }?>
                </div>
                <div class="training-item-title">
                    <?= $training->getTrainingTitle()?>
                </div>
                <div class="training-item-descr">
                    <?= $training->getTrainingDescription()?>
                </div>
                <div class="training-item-rate">
                    <div class="likes">
                        <i class="fa-solid fa-thumbs-up fa-2xl"></i>
                        <p><?= $training->getLikes()?></p>
                    </div>
                    <div class="dislikes">
                        <i class="fa-solid fa-thumbs-down fa-2xl"></i>
                        <p><?= $training->getDislikes()?></p>
                    </div>
                </div>
                <div class="training-photo-position">
                    <div class="training-user-photo">
                        <img class="user-profile-img" src="public/uploads/<?= $training->getUserPhoto() ?>">
                    </div>
                </div>
                <div class="training-username"> <p><?= $training->getUsername()?></p>
                </div>

            </div></a>
        <?php endforeach; }?>
        </section>
    </div>

    <template id="training-template">
    <a href="/">
        <div class="training-item">
            <div class="training-item-usr">
            </div>
            <div class="training-item-title">
            </div>
            <div class="training-item-descr">
            </div>
            <div class="training-item-rate">
                <div class="likes">
                    <i class="fa-solid fa-thumbs-up fa-2xl"></i>
                </div>
                <div class="dislikes">
                    <i class="fa-solid fa-thumbs-down fa-2xl"></i>
                </div>
            </div>
            <div class="training-photo-position">
                <div class="training-user-photo">
                    <img class="user-profile-img" src="public/uploads/">
                </div>
            </div>
            <div class="training-username">
            </div>
        </div></a>
    </template>


</div>



</body>
</html>