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
            console.log('inside_add_exercise');
            var trainingDayBtnId="#add-exe-btn-d"+trainingDayId;
            exerciseForDayCounter[trainingDayId]++;
            let newExerciseId="add-ex-"+trainingDayId+"-"+exerciseForDayCounter[trainingDayId];
            /*$(trainingDayBtnId).before('<div class="add-excercise-details" id="'+newExerciseId+'"> <input type="text" placeholder="'+newExerciseId+'"> </div>');
            */
            $(trainingDayBtnId).before('<div class="add-exercise-details" id="'+newExerciseId+'"> <div class="my-inline-pos"> <select class="select-add-exercise" id="sel-'+newExerciseId+'" name="exc" > <option value="" selected disabled hidden>Choose exercise</option> <option value="bench_press">Bench press</option> <option value="deadlift">Deadlift</option> </select> <i class="fa-solid fa-trash fa-2xl" onclick="delete_exercise('+newExerciseId+')"></i> </div> <div class="my-inline-pos"> <p>Series:</p> <input type="text"  placeholder="Series"> </div> <div class="my-inline-pos"> <p>Reps:</p> <input type="text" placeholder="Reps"> </div> </div>');
        }
        function delete_exercise(exercise_id)
        {
            console.log("del_ex: "+exercise_id);

            var delimeterIndex = exercise_id.indexOf("-",7);
            console.log("delimeterIndex= "+delimeterIndex);

            var localTrainingDayId = exercise_id.substring(7,delimeterIndex);
            var localDelExerciseId = exercise_id.substring(delimeterIndex+1)

            console.log("trainingDayId= "+localTrainingDayId+" \nexerciseId= "+ localDelExerciseId);

            $('#'+exercise_id).remove();
            console.log("before loop");

            var it = parseInt(localDelExerciseId)+1;

            while(document.getElementById("add-ex-"+localTrainingDayId+"-"+it)!=null){
                console.log("test add-ex-"+localTrainingDayId+"-"+it+"\n");

                var tmpId=it-1;
                document.getElementById("add-ex-"+localTrainingDayId+"-"+it).setAttribute("id","add-ex-"+localTrainingDayId+"-"+tmpId)



                it++;
            }

            console.log("after loop");

        }

        function add_trainingday()
        {
            trainingDayCounter++;
            exerciseForDayCounter[trainingDayCounter]=0;
            const localTrainingDayId=trainingDayCounter;
            var trainingDayBtnId="#add-exe-btn-d"+trainingDayCounter;
            $("#add-tng-day-btn").before('<div class="training-day-box" id="add-day-'+trainingDayCounter+'"> <div class="training-box-day-number"> <p>Day '+trainingDayCounter+'</p> </div> <div class="training-box-exercise-list" id="trn-day-'+trainingDayCounter+'"> <div id="add-exe-btn-d'+trainingDayCounter+'" class="add-exercise-btn" onclick="add_exercise('+trainingDayCounter+')"><i class="fa-solid fa-plus fa-2xl"></i> <p class="p-add-workout">Add workout</p> </div> </div> </div>');
        }

        function deleteTrainingDay(trainingDayId)
        {
            console.log("del_day: "+trainingDayId);


            var localTrainingDayId = "add-day-"+trainingDayId;

            $('#'+localTrainingDayId).remove();
            console.log("before loop");

            var it = parseInt(trainingDayId)+1;

            while(document.getElementById("add-day-"+it)!=null){
                console.log("test add-day-"+it+"\n");

                // -------- TO DO: decrement id of training day divs/exercises inside and change day description
                console.log(document.getElementById("add-day-"+it).innerHTML);
                let content = document.getElementById("add-day-"+it);
                console.log(content.firstElementChild.innerHTML);
                var tmpNewDayId=it-1;
                content.firstElementChild.innerHTML="<p>Day "+tmpNewDayId+"</p>";
                trainingDayCounter--;




                it++;
            }

            console.log("after loop");

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