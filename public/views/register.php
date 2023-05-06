<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="icon" type="image/x-icon" href="/public/img/logo_icon.svg">
    <title>Gymster</title>

    <script type="text/javascript" src="/public/js/register.js" defer></script>

</head>
<body>
    <div class="register-base-container">
        <div class="logo-container">
            <div class="logo-icon">
                <img src="public/img/logo_icon.svg" onclick="location.href='/';" class="icon">
            </div>
            <div class="logo-text">
                <img src="public/img/logo.svg" onclick="location.href='/';">
            </div>
        </div>
        <div class="register-container">
            <form name="registerForm" method="POST" action="register" class="register" onsubmit="return validateFrom()">
                <input name="username" type="text" placeholder="username">
                <input name="email" type="text" placeholder="email@email.com">
                <input name="password" type="password" placeholder="password">
                <input name="repeatPassword" type="password" placeholder="repeat password">
                <button type="submit">Register</button>
                <div class="error-message">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
            </form>


        </div>
    </div>



</body>