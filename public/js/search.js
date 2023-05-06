const search = document.querySelector('input[placeholder="Search training..."]');
const trainingContiner = document.querySelector(".trainings-sec");

function getCookie(cookieName) {
    let cookie = {};
    document.cookie.split(';').forEach(function(el) {
        let [key,value] = el.split('=');
        cookie[key.trim()] = value;
    })
    return cookie[cookieName];
}

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        fetchTrainings();
    }
});

function fetchTrainings(){
    const data = {search: search.value};

    fetch("/search", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (trainings) {
        console.log(trainings);
        trainingContiner.innerHTML = "";
        loadTrainings(trainings)
    });
}


function loadTrainings(trainings) {
    trainings.forEach(training => {
        createTraining(training);
    });
}

function createTraining(training) {
    const template = document.querySelector("#training-template");
    const clone = template.content.cloneNode(true);

    const a = clone.querySelector("a");
    a.href = `/trainingdetails/${training.training_id}`;

    const sessionUserId= getCookie('userId');
    if(String(sessionUserId)===String(training.user_id)){
        const propertyImage = clone.querySelector(".training-item-usr");
        propertyImage.innerHTML = '<i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i>';
    }

    const title = clone.querySelector(".training-item-title");
    title.innerHTML = training.title;

    const description = clone.querySelector(".training-item-descr");
    description.innerHTML = training.description;

    const like = clone.querySelector(".fa-thumbs-up");
    like.innerText = training.likes;

    const dislike = clone.querySelector(".fa-thumbs-down");
    dislike.innerText = training.dislikes;

    const image = clone.querySelector("img");
    image.src = `/public/uploads/${training.image}`;

    const username = clone.querySelector(".training-username");
    username.innerHTML = training.username;

    trainingContiner.appendChild(clone);
}
