
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
    <div class="panel-details-container">
        <form method="post" action="/addexercise" class="panel-details-form">
            <input name="exercise" placeholder="exercise name">
            <button type="submit">Add exercise</button>
        </form>

    </div>
</div>
</body>
</html>
