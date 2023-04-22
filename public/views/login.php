<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
<title>Login page</title>


</head>
<body>
    <div class="container">
        <div class="logo-container">
            <div class="logo-icon">
                <img src="public/img/logo_icon.svg" class="icon">
            </div>
            <div class="logo-text">
                <img src="public/img/logo.svg">
            </div>
        </div>
        <div class="login-container">
            <form method="POST" action="login" class="login">
                <input name="username" type="text" placeholder="username">
                <input name="password" type="password" placeholder="password">
                <button type="submit">Log in</button>
                <div class="login-error-message">
                <?php
                    if(isset($messages)){
                        echo $messages['errorLogin'];
                    }

                ?></div>
                <label for="register">Don't have an account? Register <b><a href="/register">here</a></b></label>
            </form>
        </div>
    </div>



</body>