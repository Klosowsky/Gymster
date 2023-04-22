<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
<title>Register page</title>


</head>
<body>
    <div class="register-base-container">
        <div class="logo-container">
            <div class="logo-icon">
                <img src="public/img/logo_icon.svg" class="icon">
            </div>
            <div class="logo-text">
                <img src="public/img/logo.svg">
            </div>
        </div>
        <div class="register-container">
            <form method="POST" action="register" class="register">
                <input name="username" type="text" placeholder="username">
                <input name="email" type="text" placeholder="email@email.com">
                <input name="password" type="password" placeholder="password">
                <input name="repatPassword" type="password" placeholder="repeat password">
                <div class="checkbox-inline"><input name="check" type="checkbox"><label for="check" class="check-label">Wyrazam...</label></div>
                <button type="submit">Register</button>
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