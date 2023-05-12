<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/trainings.css">
    <meta charset="UTF-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>Gymster</title>

    <script type="text/javascript">
/*
        function handleTrainingMenuButtons(buttonId){
            console.log("test");
            const menuButtons=["allTrainings","myTrainings","FavTrainings"];
            menuButtons.forEach(item=>setColor(item,buttonId));
            console.log("test");
        }
        function setColor(buttonId,chosenButtonId){
            if(buttonId===chosenButtonId){
                document.getElementById(buttonId).style.background='#3D4750';
            }
            else{
                document.getElementById(buttonId).style.background='#505A63';
            }
        }

*/


    </script>
    <script type="text/javascript" src="/public/js/search.js" defer></script>
    <script src="https://kit.fontawesome.com/ab1fdc6776.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include 'public/views/header.php';?>

<div class="main-container">
    <div class="main-tool-bar">
        <div class="search-training-bar">
            <input class="search-training-input" type="text" placeholder="Search training...">
            <i class="fa-solid fa-magnifying-glass fa-2xl" onclick="fetchTrainings()"></i>
        </div>

        <div class="add-training-btn" onclick="location.href='/addtraining';" style="cursor: pointer;">
            <!--<a class="a-add-btn" href="/addtraining">-->
                <i class="fa-solid fa-plus fa-2xl"></i>
                <p class="p-add-workout">Add training</p>
                <!--<input class="add-training-button" type="button" value="Add workout"<i class="fa-solid fa-plus"></i>-->
            <!--</a>-->
        </div>

    </div>

    <!--<div class="trainings-menu-container">
        <input class="menu-trainings-button" type="button" id="allTrainings" onClick="handleTrainingMenuButtons('allTrainings')" value="All" >
        <input class="menu-trainings-button" type="button" id="myTrainings" onClick="handleTrainingMenuButtons('myTrainings')" value="My">
        <input class="menu-trainings-button" type="button" id="FavTrainings" onClick="handleTrainingMenuButtons('FavTrainings')" value="Fav">
    </div>-->
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
                    <!--<i class="fa-regular fa-star fa-2xl"></i>
                    <i class="fa-solid fa-star fa-2xl"></i>-->
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
                 <!--take from session in js!-->
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