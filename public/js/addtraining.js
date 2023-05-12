
function validateTrainingForm(){

    var title= document.getElementById('trng-title');
    var description= document.getElementById('trng-desc');
    var titleBox= document.getElementById('trng-title-box');
    var descriptionBox= document.getElementById('trng-desc-box');
    var container = document.getElementById('trng-days-cont');
    var daysCounter = container.getElementsByClassName('training-day-box').length;
    var result = true;

    if(title.value.length>50||title.value.length<5){
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