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
    $("#add-tng-day-btn").before('<div class="training-day-box" id="add-day-'+trainingDayCounter+'"> <div class="training-box-day-number"> <i class="fa-solid fa-chevron-up fa-xl" id="collapse-training-day" onclick="collapseTrainingDay(this)"></i> <p>Day '+trainingDayCounter+'</p> <i class="fa-solid fa-trash fa-xl" id="delete-trng-day-icon" style="position: absolute; right: 20px;" onclick="deleteLastTrainingDay()"></i> </div> <div class="training-box-add-exercise-list" id="trn-day-'+trainingDayCounter+'"> <div id="add-exe-btn-d'+trainingDayCounter+'" class="add-exercise-btn" onclick="add_exercise('+trainingDayCounter+')"><i class="fa-solid fa-plus fa-2xl"></i> <p class="p-add-workout">Add exercise</p> </div> </div> </div>');
}

function deleteLastTrainingDay() {
    console.log("del_day");

    var localTrainingDayId = "add-day-" + trainingDayCounter;

    $('#' + localTrainingDayId).remove();
    exerciseForDayCounter[trainingDayCounter] = 0;
    trainingDayCounter--;

    if (trainingDayCounter > 1) {
        var lastTrainingDay = document.getElementById("add-day-" + trainingDayCounter).firstElementChild.innerHTML;
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


function validateTrainingForm(){

    var title= document.getElementById('trng-title');
    var description= document.getElementById('trng-desc');
    var titleBox= document.getElementById('trng-title-box');
    var descriptionBox= document.getElementById('trng-desc-box');
    var container = document.getElementById('trng-days-cont');
    var daysCounter = container.getElementsByClassName('training-day-box').length;
    var result = true;

    if(title.value.length>40||title.value.length<5){
        console.log("NULL title: ");
        titleBox.style.borderColor = 'red';
        result=false;
    }
    else{
        titleBox.style.borderColor = 'gray';
    }

    if(description.value.length>100||description.value.length<5){
        console.log("NULL desc: ");
        descriptionBox.style.borderColor = 'red';
        result=false;
    }
    else{
        descriptionBox.style.borderColor = 'gray';
    }


    console.log("days counter: "+daysCounter);
    for (var day = 0; day < daysCounter; day++) {
        var dayCont = document.getElementById('trn-day-'+(day+1));
        var exercisesCounter = dayCont.getElementsByClassName('add-exercise-details').length;
        console.log("ex counter: "+exercisesCounter);
        for (var exercise = 0; exercise < exercisesCounter; exercise++) {
            var selEl=document.getElementById('sel-add-ex-'+(day+1)+'-'+(exercise+1));
            var serEl=document.getElementById('ser-add-ex-'+(day+1)+'-'+(exercise+1));
            var repEl=document.getElementById('rep-add-ex-'+(day+1)+'-'+(exercise+1));
            if(selEl.value===''){
                console.log("NULL selVal: ");
                selEl.style.borderColor = 'red';
                result=false;
            }
            else{
                selEl.style.borderColor = 'gray';
            }
            if(isNaN(parseInt(serEl.value))||serEl.value<1||serEl.value>50){
                console.log("ERR ser: ");
                serEl.style.borderColor = 'red';
                result=false;
            }
            else{
                serEl.style.borderColor = 'gray';
            }
            if(isNaN(parseInt(repEl.value))||repEl.value<1||repEl.value>50){
                console.log("ERR repEl: ");
                repEl.style.borderColor = 'red';
                result=false;
            }
            else{
                repEl.style.borderColor = 'gray';
            }

            console.log("ex selVal: "+selEl.value);
            console.log("ex serVal: "+serEl.value);
            console.log("ex repVal: "+repEl.value);
        }
    }
    if(!result){
        alert("Provide proper values!");
    }

    return result;
}


function submitTrainingForm(){
    if(validateTrainingForm()){
        document.getElementById('training-form').submit();
    }
}