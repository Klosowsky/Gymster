
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/trainings.css">
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/public/img/logo_icon.svg">
    <title>Gymster</title>

    <script src="https://kit.fontawesome.com/ab1fdc6776.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include 'public/views/header.php';?>

<div class="simple-container">
    <div class="panel-details-container">
        <form method="post" action="/uploadexercise" class="panel-details-form">
            <input name="exercise" placeholder="exercise name">
            <button type="submit">Add exercise</button>
            <div class="error-message">
                <?php
                if(isset($messages)){
                    echo $messages['error'];
                }
                ?>
            </div>
            <div class="success-message">
                <?php
                if(isset($messages)){
                    echo $messages['success'];
                }
                ?>
            </div>
        </form>

    </div>
</div>
</body>
</html>
