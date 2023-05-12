

function validateFrom(){
    var usernameDOM=document.registerForm.username;
    var emailDOM=document.registerForm.email;
    var passDOM=document.registerForm.password;
    var repeatPassDOM=document.registerForm.repeatPassword;

    var result=true;

    if(usernameDOM.value.length>3 && usernameDOM.value.length<17){
        usernameDOM.style.borderColor = '#707070';
    }
    else{
        usernameDOM.style.borderColor = 'red';
        result=false;
    }

    if(String(emailDOM.value).includes('@')){
        emailDOM.style.borderColor = '#707070';
    }
    else{
        emailDOM.style.borderColor = 'red';
        result=false;
    }


    if((passDOM.value.length>6 && passDOM.value.length<17)&&(String(passDOM.value)===String(repeatPassDOM.value))){
        passDOM.style.borderColor = '#707070';
        repeatPassDOM.style.borderColor = '#707070';
    }
    else{
        passDOM.style.borderColor = 'red';
        repeatPassDOM.style.borderColor = 'red';
        result=false;
    }

    if(!result){
        alert("Provide proper values!");
    }


    return true;


}