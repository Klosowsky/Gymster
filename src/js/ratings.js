window.onload=getRatings;

const likeButtons = document.querySelectorAll(".fa-thumbs-up");
const dislikeButtons = document.querySelectorAll(".fa-thumbs-down");

function getCookie(cookieName) {
    let cookie = {};
    document.cookie.split(';').forEach(function(el) {
        let [key,value] = el.split('=');
        cookie[key.trim()] = value;
    })
    return cookie[cookieName];
}

function getRatings(){

    console.log('get ratings ');
    const likes= document.querySelector(".fa-thumbs-up");;
    const container = likes.parentElement.parentElement.parentElement;
    const trainingId = container.getAttribute("id");
    const userId= getCookie('userId');
    console.log('like '+userId);

    fetch(`/getratings/${trainingId}/${userId}`, {
        method: "POST",
    }).then(function (response) {
        return response.json();
    }).then(function (likesData) {
        console.log(likesData);
        handleIcons(likesData.isLiked,likesData.isDisliked);
    });


}

function handleIcons(isLiked,isDisliked){
    const likes = document.querySelector(".fa-thumbs-up");
    const dislikes= document.querySelector(".fa-thumbs-down");
    if(isLiked===true){
        console.log("liked true");
        likes.style.fontWeight='1000';
    }
    if(isLiked===false){
        console.log("liked true");
        likes.style.fontWeight='100';
    }
    if(isDisliked===true){
        console.log("liked true");
        dislikes.style.fontWeight='1000';
    }
    if(isDisliked===false){
        console.log("liked true");
        dislikes.style.fontWeight='100';
    }
}
function giveLike() {

    const likes = this;
    const dislikes= document.querySelector(".fa-thumbs-down");
    const container = likes.parentElement.parentElement.parentElement;
    const trainingId = container.getAttribute("id");
    const userId= getCookie('userId');
    console.log('like '+userId);

    fetch(`/setlike/${trainingId}/${userId}`, {
        method: "POST",
    }).then(function (response) {
        return response.json();
    }).then(function (likesData) {
        console.log(likesData);
        likes.innerHTML = parseInt(likesData.likes);
        dislikes.innerHTML = parseInt(likesData.dislikes);
        handleIcons(likesData.isLiked,likesData.isDisliked);
    });

}



function giveDislike() {
    const likes= document.querySelector(".fa-thumbs-up");
    const dislikes = this;
    const container = dislikes.parentElement.parentElement.parentElement;
    const trainingId = container.getAttribute("id");
    const userId= getCookie('userId');
    console.log('like '+userId);

    fetch(`/setdislike/${trainingId}/${userId}`, {
        method: "POST",
    }).then(function (response) {
        return response.json();
    }).then(function (likesData) {
        console.log(likesData);
        likes.innerHTML = parseInt(likesData.likes);
        dislikes.innerHTML = parseInt(likesData.dislikes);
        handleIcons(likesData.isLiked,likesData.isDisliked);
    });
}

likeButtons.forEach(button => button.addEventListener("click", giveLike));
dislikeButtons.forEach(button => button.addEventListener("click", giveDislike));