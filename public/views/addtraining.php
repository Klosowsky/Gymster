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
            var arrName=""+trainingDayId;
            /*$(trainingDayBtnId).before('<div class="add-exercise-details" id="'+newExerciseId+'"> <div class="my-inline-pos"> <select class="select-add-exercise" id="sel-'+newExerciseId+'" name="exercise['+trainingDayId+'][]" > <option value="" selected disabled hidden>Choose exercise</option> <option value="bench_press">Bench press</option> <option value="deadlift">Deadlift</option> </select> <i class="fa-solid fa-trash fa-2xl" id="teeeest" onclick="delete_exercise(this)"></i> </div> <div class="my-inline-pos"> <p>Series:</p> <input type="text" name="series['+trainingDayId+'][]" placeholder="Series"> </div> <div class="my-inline-pos"> <p>Reps:</p> <input type="text" name="reps['+trainingDayId+'][]" placeholder="Reps"> </div> </div>');
*/
           /* $(trainingDayBtnId).before('<div class="add-exercise-details" id="'+newExerciseId+'"> <div class="my-inline-pos"> <select class="select-add-exercise" id="sel-'+newExerciseId+'" name="training['+arrName+'][exercise'+newExerciseId+']" > <option value="" selected disabled hidden>Choose exercise</option> <option value="bench_press">Bench press</option> <option value="deadlift">Deadlift</option> </select> <i class="fa-solid fa-trash fa-2xl" id="teeeest" onclick="delete_exercise(this)"></i> </div> <div class="my-inline-pos"> <p>Series:</p> <input type="text" name="training['+arrName+'][series'+newExerciseId+']" placeholder="Series"> </div> <div class="my-inline-pos"> <p>Reps:</p> <input type="text" name="training['+arrName+'][reps'+newExerciseId+']" placeholder="Reps"> </div> </div>');
*/
            $(trainingDayBtnId).before('<div class="add-exercise-details" id="'+newExerciseId+'"> <div class="my-inline-pos"> <select class="select-add-exercise" id="sel-'+newExerciseId+'" name="'+arrName+'[exercise]['+exerciseForDayCounter[trainingDayId]+']" > <option value="" selected disabled hidden>Choose exercise</option> <option value="bench_press">Bench press</option> <option value="deadlift">Deadlift</option> </select> <i class="fa-solid fa-trash fa-2xl" id="teeeest" onclick="delete_exercise(this)"></i> </div> <div class="my-inline-pos"> <p>Series:</p> <input type="text" name="'+arrName+'[series]['+exerciseForDayCounter[trainingDayId]+']" id="ser-'+newExerciseId+'" placeholder="Series" > </div> <div class="my-inline-pos"> <p>Reps:</p> <input type="text" name="'+arrName+'[reps]['+exerciseForDayCounter[trainingDayId]+']" id="rep-'+newExerciseId+'" placeholder="Reps"> </div> </div>');


        }

        function delete_exercise(element)
        {

            console.log('inside_del_exercise');

            var exercise_id = String($(element).parent().parent().attr("id"));
            console.log("del_ex: "+exercise_id);

            var delimeterIndex = exercise_id.indexOf("-",7);
            console.log("delimeterIndex= "+delimeterIndex);

            var localTrainingDayId = exercise_id.substring(7,delimeterIndex);
            var localDelExerciseId = exercise_id.substring(delimeterIndex+1)

            console.log("trainingDayId= "+localTrainingDayId+" \nexerciseId= "+ localDelExerciseId);

            $('#'+exercise_id).remove();
            exerciseForDayCounter[localTrainingDayId]--;

            console.log("before loop");

            var it = parseInt(localDelExerciseId)+1;
            while(document.getElementById("add-ex-"+localTrainingDayId+"-"+it)!=null){
                console.log("test add-ex-"+localTrainingDayId+"-"+it+"\n");
                var tmpId=it-1;
                document.getElementById("add-ex-"+localTrainingDayId+"-"+it).setAttribute("id","add-ex-"+localTrainingDayId+"-"+tmpId);
                document.getElementById("sel-add-ex-"+localTrainingDayId+"-"+it).setAttribute("name",""+localTrainingDayId+"[exercise]["+exerciseForDayCounter[localTrainingDayId]+"]");
                document.getElementById("sel-add-ex-"+localTrainingDayId+"-"+it).setAttribute("id","sel-add-ex-"+localTrainingDayId+"-"+tmpId);
                document.getElementById("ser-add-ex-"+localTrainingDayId+"-"+it).setAttribute("name",""+localTrainingDayId+"[series]["+exerciseForDayCounter[localTrainingDayId]+"]");
                document.getElementById("ser-add-ex-"+localTrainingDayId+"-"+it).setAttribute("id","ser-add-ex-"+localTrainingDayId+"-"+tmpId);
                document.getElementById("rep-add-ex-"+localTrainingDayId+"-"+it).setAttribute("name",""+localTrainingDayId+"[reps]["+exerciseForDayCounter[localTrainingDayId]+"]");
                document.getElementById("rep-add-ex-"+localTrainingDayId+"-"+it).setAttribute("id","rep-add-ex-"+localTrainingDayId+"-"+tmpId);
                it++;
            }
            console.log("after loop");

        }

        function add_trainingday()
        {
            trainingDayCounter++;
            exerciseForDayCounter[trainingDayCounter]=0;
            $('#delete-trng-day-icon').remove();
            $("#add-tng-day-btn").before('<div class="training-day-box" id="add-day-'+trainingDayCounter+'"> <div class="training-box-day-number"> <i class="fa-solid fa-chevron-up fa-xl" id="collapse-training-day" onclick="collapseTrainingDay(this)"></i> <p>Day '+trainingDayCounter+'</p> <i class="fa-solid fa-trash fa-xl" id="delete-trng-day-icon" style="position: absolute; right: 20px;" onclick="deleteLastTrainingDay()"></i> </div> <div class="training-box-exercise-list" id="trn-day-'+trainingDayCounter+'"> <div id="add-exe-btn-d'+trainingDayCounter+'" class="add-exercise-btn" onclick="add_exercise('+trainingDayCounter+')"><i class="fa-solid fa-plus fa-2xl"></i> <p class="p-add-workout">Add exercise</p> </div> </div> </div>');
        }

        function deleteLastTrainingDay() {
            console.log("del_day");

            var localTrainingDayId = "add-day-" + trainingDayCounter;

            $('#' + localTrainingDayId).remove();
            exerciseForDayCounter[trainingDayCounter] = 0;
            trainingDayCounter--;

            if (trainingDayCounter > 1) {
                var lastTrainingDay = document.getElementById("add-day-" + trainingDayCounter).firstElementChild.innerHTML;
                /*document.getElementById("add-day-" + trainingDayCounter).firstElementChild.innerHTML = '<p>Day ' + trainingDayCounter + '</p> <i class="fa-solid fa-trash fa-xl" id="delete-trng-day-icon" style="position: absolute; right: 20px;" onclick="deleteLastTrainingDay()"></i>';
            */
                var lastTrainingDay1 = document.getElementById("add-day-" + trainingDayCounter).firstElementChild;
                var pElem=lastTrainingDay1.querySelector("p");
                console.log(pElem.innerHTML);
                $(pElem).after('<i class="fa-solid fa-trash fa-xl" id="delete-trng-day-icon" style="position: absolute; right: 20px;" onclick="deleteLastTrainingDay()"></i>'); //

            }

        }

        function collapseTrainingDay(element){
            console.log('test')
            var trainingDayId= String($(element).parent().parent().attr("id"));
            console.log('id of day: '+trainingDayId);
            var dayListId = "#add-day-"+trainingDayId.substring(8);
            console.log('num of day: '+dayListId);
            var exListElem= document.getElementById("trn-day-"+trainingDayId.substring(8));

            var dayElement= document.querySelector(dayListId);
            var iElem = dayElement.querySelector("#collapse-training-day");

            exListElem.style.display="none";
            iElem.onclick= function () { expandTrainingDay(this);};
            iElem.className="fa-solid fa-chevron-down  fa-xl";
        }

        function expandTrainingDay(element){
            console.log('expand')
            var trainingDayId= String($(element).parent().parent().attr("id"));
            console.log('id of day: '+trainingDayId);
            var dayListId = "#add-day-"+trainingDayId.substring(8);
            console.log('num of day: '+dayListId);
            var exListElem= document.getElementById("trn-day-"+trainingDayId.substring(8));

            var dayElement= document.querySelector(dayListId);
            var iElem = dayElement.querySelector("#collapse-training-day");

            exListElem.style.display="flex";
            iElem.onclick= function () { collapseTrainingDay(this);};
            iElem.className="fa-solid fa-chevron-up  fa-xl";


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
                <textarea maxlength="100" class="new-training-desc" placeholder="Your description..."></textarea>
            </div>
        </div>

        <div class="add-training-buttons-box">
            <div class="upload-training" onClick="document.forms['training-form'].submit();">
                <i class="fa-sharp fa-solid fa-arrow-up-from-bracket fa-2xl"></i>
                <p class="p-add-workout">Upload training</p>
            </div>


        </div>

    </div>
    <form id="training-form" name="training-form" action="/uploadtraining" method="post" class="add-training-form">
        <div class="training-add-days-container">
                <div class="training-day-box" id="add-day-1">
                    <div class="training-box-day-number">
                        <i class="fa-solid fa-chevron-up fa-xl" id="collapse-training-day" onclick="collapseTrainingDay(this)"></i>
                        <p>Day 1</p>
                    </div>
                    <div class="training-box-exercise-list" id="trn-day-1">

                        <!--<div class="add-exercise-details" id="'+newExerciseId+'">
                            <div class="my-inline-pos">
                                <select class="select-add-exercise" id="sel-'+newExerciseId+'" name="ex" >
                                    <option value="" selected disabled hidden>Choose exercise</option>
                                    <option value="bench_press">Bench press</option>
                                    <option value="deadlift">Deadlift</option>
                                </select>
                                <i class="fa-solid fa-trash fa-2xl" id="teeeest" onclick="delete_exercise(this)"></i>
                            </div>
                            <div class="my-inline-pos">
                                <p>Series:</p>
                                <input name="ser" type="text"  placeholder="Series">
                            </div> <div class="my-inline-pos">
                                <p>Reps:</p>
                                <input name="rep" type="text" placeholder="Reps">
                            </div>
                        </div>-->

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