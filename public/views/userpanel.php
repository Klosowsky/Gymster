
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/trainings.css">
    <meta charset="UTF-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>Gymster</title>

    <script src="https://kit.fontawesome.com/ab1fdc6776.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include 'public/views/header.php';?>

<div class="simple-container">
    <div class="update-user-details-container">
        <form action="setuserdetails" class="user-details-form" method="post" ENCTYPE="multipart/form-data">
            <input type="file" name="photo">
            <input name="email" type="text" placeholder="email">
            <input name="first_name" type="text" placeholder="first name">
            <input name="second_name" type="text" placeholder="second name">
            <button type="submit">Update</button>

        </form>
        <?php
        if(isset($messages)){
            foreach($messages as $message) {
                echo $message;
            }
        }
        ?>


    </div>



</div>

</body>
</html>