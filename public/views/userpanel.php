
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/trainings.css">
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/public/img/tab_logo.png">
    <title>Gymster</title>

    <script src="https://kit.fontawesome.com/ab1fdc6776.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include 'public/views/header.php';?>

<div class="simple-container">
    <div class="panel-details-container">
        <form action="setuserdetails" class="panel-details-form" method="post" ENCTYPE="multipart/form-data">
            <input type="file" name="photo">
            <input name="email" type="text" placeholder="email">
            <input name="first_name" type="text" placeholder="first name">
            <input name="second_name" type="text" placeholder="second name">
            <button type="submit">Update</button>
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