<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/trainings.css">
    <title>Gymster</title>

    <script type="text/javascript">
        function handleTrainingMenuButtons(buttonId){
            console.log("test");
            const menuButtons=["allTrainings","myTrainings","FavTrainings"];
            menuButtons.forEach(item=>setColor(item,buttonId));
            console.log("test");
        }
        function setColor(buttonId,chosenButtonId){
            if(buttonId===chosenButtonId){
                document.getElementById(buttonId).style.background='#3D4750';
            }
            else{
                document.getElementById(buttonId).style.background='#505A63';
            }
        }



    </script>
</head>
<body>
<div class="trainings-header">
    <div class="header-logo">
        <img class="header-logo-img" src="public/img/logo.svg">
    </div>


    <div class="header-user-details">
        <div class="user-username"> ExampleUser123
        </div>
       <div class="user-photo">
           <img class="user-profile-img" src="public/uploads/Will_Smith.jpg">
       </div>
    </div>
</div>

<div class="main-container">
    <div class="main-tool-bar">
        <div class="search-training-bar">
            <input class="search-training-input" type="text" placeholder="Search...">
        </div>
        <div class="add-training-btn">
            <input class="add-training-button" type="button" value="Add workout">
        </div>
    </div>

    <div class="trainings-menu-container">
        <input class="menu-trainings-button" type="button" id="allTrainings" onClick="handleTrainingMenuButtons('allTrainings')" value="All" >
        <input class="menu-trainings-button" type="button" id="myTrainings" onClick="handleTrainingMenuButtons('myTrainings')" value="My">
        <input class="menu-trainings-button" type="button" id="FavTrainings" onClick="handleTrainingMenuButtons('FavTrainings')" value="Fav">
    </div>
    <div class="trainings-main-container">
        <section class="trainings-sec">
            <?php for($i = 0; $i < 10; $i += 1): ?>
            <div class="training-item">
                <div class="training-item-fav">
                    fav
                </div>
                <div class="training-item-title">
                    FBW training
                </div>
                <div class="training-item-descr">
                    This training is for...<br>
                    This training is for...<br>
                    This training is for...ababab ababab ababab ababab ababab ababab ababab ababab ababab ababab ababab ababab ababab ababab ababab ababab<br>
                    This training is for...<br>
                </div>
                <div class="training-item-rate">
                    <div class="likes">
                        like
                    </div>
                    <div class="dislikes">
                        dislike
                    </div>
                </div>
                <div class="training-user-photo">
                    <img class="user-profile-img" src="public/uploads/Will_Smith.jpg">
                </div>
                <div class="training-username"> ExampleUser123 <br>Advanced
                </div>

            </div>
        <?php endfor; ?>
        </section>
    </div>



</div>



</body>
</html>