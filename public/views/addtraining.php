<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/trainings.css">
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/public/img/logo_icon.svg">
    <title>Gymster</title>

    </script>
    <script src="https://kit.fontawesome.com/ab1fdc6776.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="public/js/jquery.js"></script>

    <script type="text/javascript">
        var trainingDayCounter=1;
        var exerciseForDayCounter = [];
        exerciseForDayCounter[1]=0;

        function add_exercise(trainingDayId)
        {
            console.log('inside_add_exercise');
            var trainingDayBtnId="#add-exe-btn-d"+trainingDayId;
            exerciseForDayCounter[trainingDayId]++;
            let newExerciseId="add-ex-"+trainingDayId+"-"+exerciseForDayCounter[trainingDayId];
            var arrName=""+trainingDayId;

            $(trainingDayBtnId).before('<div class="add-exercise-details" id="'+newExerciseId+'"> <div class="my-inline-pos"> <select class="select-add-exercise" id="sel-'+newExerciseId+'" name="'+arrName+'[exercise]['+exerciseForDayCounter[trainingDayId]+']" > ' +
                '<option value="" selected disabled hidden>Choose exercise</option> ' +
                '<?php  if(isset($exercises)){ foreach($exercises as $exercise) :?><option value="<?= $exercise->getExerciseId();?>"> <?= $exercise->getExerciseName();?> </option> <?php endforeach;}?>'+
                '</select> <i class="fa-solid fa-trash fa-2xl" id="teeeest" onclick="delete_exercise(this)"></i> </div> <div class="my-inline-pos"> <p>Series:</p> <input type="number" min="1" max="20" name="'+arrName+'[series]['+exerciseForDayCounter[trainingDayId]+']" id="ser-'+newExerciseId+'" placeholder="Series" > </div> <div class="my-inline-pos"> <p>Reps:</p> <input type="number" min="1" max="50" name="'+arrName+'[reps]['+exerciseForDayCounter[trainingDayId]+']" id="rep-'+newExerciseId+'" placeholder="Reps"> </div> </div>');

        }


    </script>

    <script type="text/javascript" src="/public/js/addtraining.js" defer></script>

</head>
<body>

<?php include 'public/views/header.php';?>

<div class="training-details-container">
    <div class="add-training-general-info-container">
        <div class="add-training-title-box" id="trng-title-box">
            <div class="add-training-title-header">
                <p>Title</p>
            </div>
            <div class="add-training-title-content">
                <textarea form="training-form" id="trng-title" maxlength="40" class="new-training-title" name="trng-title" placeholder="Your title..."></textarea>
            </div>
        </div>

        <div class="add-training-desc-box" id="trng-desc-box">
            <div class="add-training-desc-header">
                <p>Description</p>
            </div>
            <div class="add-training-desc-content">
                <textarea form="training-form" id="trng-desc" maxlength="100" class="new-training-desc" name="trng-desc" placeholder="Your description..."></textarea>
            </div>
        </div>

        <div class="add-training-buttons-box">
            <div class="upload-training" onClick="submitTrainingForm();">
                <i class="fa-sharp fa-solid fa-arrow-up-from-bracket fa-2xl"></i>
                <p class="p-add-workout">Upload training</p>
            </div>

        </div>

    </div>
    <form id="training-form" name="training-form" action="/uploadtraining" method="post" class="add-training-form">
        <div class="training-add-days-container" id="trng-days-cont">
                <div class="training-day-box" id="add-day-1">
                    <div class="training-box-day-number">
                        <i class="fa-solid fa-chevron-up fa-xl" id="collapse-training-day" onclick="collapseTrainingDay(this)"></i>
                        <p>Day 1</p>
                    </div>
                    <div class="training-box-add-exercise-list" id="trn-day-1">

                        <div id="add-exe-btn-d1" class="add-exercise-btn" onclick="add_exercise(1)">
                            <i class="fa-solid fa-plus fa-2xl"></i>
                            <p class="p-add-workout">Add exercise</p>
                        </div>

                    </div>
                </div>

            <div id="add-tng-day-btn" class="add-training-day-btn" onclick="add_trainingday()" >
                <i class="fa-solid fa-plus fa-2xl"></i>
            </div>

        </div>
    </form>


</div>


</body>
</html>