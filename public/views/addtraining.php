<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/trainings.css">
    <meta charset="UTF-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>Gymster</title>

    </script>
    <script src="https://kit.fontawesome.com/ab1fdc6776.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="src/js/jquery.js"></script>
    <script type="text/javascript">
        function add_row()
        {
            $rowno=1;

            $("#add-ex-1-1").after('<div class="add-excercise-details" id="add-ex-1-2"> <input type="text" placeholder="exercise nie2"> </div>');
        }
        function delete_row(rowno)
        {
            $('#'+rowno).remove();
        }
    </script>

</head>
<body>

<?php include 'public/views/header.php';?>

<div class="training-details-container">
    <div class="add-training-general-info-container">
        <div class="add-training-title-box">
            <div class="add-training-title-header">
                <p>Title</p>
            </div>
            <div class="add-training-title-content">
                <textarea maxlength="50" class="new-training-title" placeholder="Your title..."></textarea>
            </div>
        </div>

        <div class="add-training-desc-box">
            <div class="add-training-desc-header">
                <p>Description</p>
            </div>
            <div class="add-training-desc-content">
                <textarea maxlength="50" class="new-training-desc" placeholder="Your description..."></textarea>
            </div>
        </div>

        <div class="add-training-buttons-box">
            <div class="upload-new-training">
                Add training
            </div>
            <div class="delete-new-training">
                Add training
            </div>


        </div>

    </div>

    <div class="training-days-container">
        <form action="/add-training" method="post">
            <div class="training-day-box" id="add-day-1">
                <div class="training-box-day-number">
                    <p>Day 1</p>
                </div>
                <div class="training-box-exercise-list">
                    <div class="add-excercise-details" id="add-ex-1-1">
                        <input type="text" placeholder="exercise nie">
                    </div>

                </div>
            </div>
        </form>
    </div>



</div>


</body>
</html>