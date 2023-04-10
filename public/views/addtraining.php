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

    <script type="text/javascript" src="src/js/jquery.js"></script>
    <script type="text/javascript">
        var trainingDayCounter=1;
        var exerciseForDayCounter = [];
        exerciseForDayCounter[1]=0;

        function add_exercise(trainingDayId)
        {
            var trainingDayBtnId="#add-exe-btn-d"+trainingDayId;
            exerciseForDayCounter[trainingDayId]++;
            let newExerciseId="add-ex-"+trainingDayId+"-"+exerciseForDayCounter[trainingDayId];
            $(trainingDayBtnId).before('<div class="add-excercise-details" id="'+newExerciseId+'"> <input type="text" placeholder="'+newExerciseId+'"> </div>');

        }
        function delete_exercise(rowno)
        {
            $('#'+rowno).remove();
        }

        function add_trainingday()
        {
            trainingDayCounter++;
            exerciseForDayCounter[trainingDayCounter]=0;
            const localTrainingDayId=trainingDayCounter;
            var trainingDayBtnId="#add-exe-btn-d"+trainingDayCounter;
            $("#add-tng-day-btn").before('<div class="training-day-box" id="add-day-'+trainingDayCounter+'"> <div class="training-box-day-number"> <p>Day '+trainingDayCounter+'</p> </div> <div class="training-box-exercise-list" id="trn-day-'+trainingDayCounter+'"> <input id="add-exe-btn-d'+trainingDayCounter+'" type="button" onclick="add_exercise('+trainingDayCounter+')" placeholder="add exercise"> </div> </div>');
        }
    </script>

</head>
<body>

<?php include 'public/views/header.php';?>

<div class="training-details-container">
    <div class="add-training-general-info-container">
        <div class="add-training-title-box">
            <div class="add-training-title-header">
                <p>Title</p>
            </div>
            <div class="add-training-title-content">
                <textarea maxlength="50" class="new-training-title" placeholder="Your title..."></textarea>
            </div>
        </div>

        <div class="add-training-desc-box">
            <div class="add-training-desc-header">
                <p>Description</p>
            </div>
            <div class="add-training-desc-content">
                <textarea maxlength="50" class="new-training-desc" placeholder="Your description..."></textarea>
            </div>
        </div>

        <div class="add-training-buttons-box">
            <div class="upload-new-training">
                Add training
            </div>
            <div class="delete-new-training">
                Add training
            </div>


        </div>

    </div>
    <form action="/add-training" method="post" class="add-training-form">
    <div class="training-add-days-container">
            <div class="training-day-box" id="add-day-1">
                <div class="training-box-day-number">
                    <p>Day 1</p>
                </div>
                <div class="training-box-exercise-list" id="trn-day-1">
                    <div class="add-exercise-details" id="add-ex-1-1">
                        <div class="my-inline-pos">
                            <select class="select-add-exercise" id="sel-exc-1-1" name="exc" >
                                <option value="" selected disabled hidden>Choose exercise</option>
                                <option value="bench_press">Bench press</option>
                                <option value="deadlift">Deadlift</option>
                            </select>
                            <i class="fa-solid fa-trash fa-2xl"></i>
                        </div>
                        <div class="my-inline-pos">
                            <p>Series:</p>
                            <input type="text" placeholder="series">
                        </div>
                        <div class="my-inline-pos">
                            <p>Reps:</p>
                            <input type="text" placeholder="reps">
                        </div>
                    </div>
                    <div id="add-exe-btn-d1" class="add-exercise-btn" onclick="add_exercise(1)">
                        <i class="fa-solid fa-plus fa-2xl"></i>
                        <p class="p-add-workout">Add workout</p>
                    </div>


                </div>
            </div>
            <input id="add-tng-day-btn" type="button" onclick="add_trainingday()" placeholder="add training day">

    </div>
</form>


</div>


</body>
</html>