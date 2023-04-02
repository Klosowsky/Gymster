<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/trainings.css">
    <meta charset="UTF-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>Gymster</title>

    </script>
    <script src="https://kit.fontawesome.com/ab1fdc6776.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include 'public/views/header.php';?>

<div class="training-details-container">
    <div class="training-general-info-container">
        <div class="training-general-info">
            <div class="training-item-fav">
                <i class="fa-regular fa-star fa-2xl"></i>
                <i class="fa-solid fa-star fa-2xl"></i>
            </div>
            <div class="training-item-title">
                FBW training
            </div>
            <div class="training-item-descr">
                This training is for...11<br>
                This training is for...<br>
                This training is for...ababab ababab ababab ababab ababab ababab ababab ababab ababab ababab ababab ababab ababab ababab ababab ababab<br>
                This training is for...<br>
            </div>
            <div class="training-item-rate">
                <div class="likes">
                    <i class="fa-solid fa-thumbs-up fa-2xl"></i>
                    <p>1234</p>
                </div>
                <div class="dislikes">
                    <i class="fa-solid fa-thumbs-down fa-2xl"></i> <p>321</p>
                </div>
            </div>

            <div class="training-user-photo">
                <img class="user-profile-img" src="public/uploads/Will_Smith.jpg">
            </div>
            <div class="training-username"> <p>ExampleUser123</p>
                <p class="p-exp">Advanced</p>
            </div>
        </div>
    </div>
    <div class="training-days-container">
        <?php for($i = 0; $i < 9; $i += 1): ?>
            <div class="training-day-box">
                <div class="training-box-day-number">
                    <p>Day 1</p>
                </div>
                <div class="training-box-exercise-list">
                    <?php for($j = 0; $j < 9; $j += 1): ?>
                        <div class="training-box-exercise">
                            <p class="p-exercise-name">Bench press</p>
                            <p class="p-exercise-details"> 3 series</p>
                            <p class="p-exercise-details"> 12 reps</p>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endfor; ?>
    </div>

</div>


</body>
</html>