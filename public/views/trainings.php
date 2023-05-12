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



    </script>
    <script src="https://kit.fontawesome.com/ab1fdc6776.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include 'public/views/header.php';?>

<div class="main-container">
    <div class="main-tool-bar">
        <div class="search-training-bar">
            <input class="search-training-input" type="text" placeholder="Search...">
            <i class="fa-solid fa-magnifying-glass fa-2xl"></i>
        </div>

        <div class="add-training-btn" onclick="location.href='/addtraining';" style="cursor: pointer;">
            <!--<a class="a-add-btn" href="/addtraining">-->
                <i class="fa-solid fa-plus fa-2xl"></i>
                <p class="p-add-workout">Add workout</p>
                <!--<input class="add-training-button" type="button" value="Add workout"<i class="fa-solid fa-plus"></i>-->
            <!--</a>-->
        </div>

    </div>

    <div class="trainings-menu-container">
        <input class="menu-trainings-button" type="button" id="allTrainings" onClick="handleTrainingMenuButtons('allTrainings')" value="All" >
        <input class="menu-trainings-button" type="button" id="myTrainings" onClick="handleTrainingMenuButtons('myTrainings')" value="My">
        <input class="menu-trainings-button" type="button" id="FavTrainings" onClick="handleTrainingMenuButtons('FavTrainings')" value="Fav">
    </div>
    <div class="trainings-main-container">
        <section class="trainings-sec">
            <?php  if(isset($trainings)){ foreach($trainings as $training) :?>
            <a href="/trainingdetails/<?= $training->getTrainingId()?>">
            <div class="training-item">
                <div class="training-item-fav">
                    <i class="fa-regular fa-star fa-2xl"></i>
                    <i class="fa-solid fa-star fa-2xl"></i>
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
                        <p><?= $training->getLikes()?></p>
                    </div>
                </div>
                <div class="training-photo-position">
                    <div class="training-user-photo">
                        <img class="user-profile-img" src="public/uploads/Will_Smith.jpg">
                    </div>
                </div>
                <div class="training-username"> <p><p><?= $training->getUsername()?></p></p>
                </div>

            </div></a>
        <?php endforeach; }?>
        </section>
    </div>



</div>



</body>
</html>