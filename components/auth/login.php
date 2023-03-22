<?php

?>

<!DOCTYPE html>
<html>
    <head>
        <title id="title">Login</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1; user-scalable=0">
        <meta name="author" content="Camsdono Studios">
        <meta name="description" content="A better place to keep track of your bugs and manage teams">

        <link rel="apple-touch-icon" sizes="180x180" href="../../images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon/favicon-16x16.png">
        <link rel="manifest" href="../../images/favicon/site.webmanifest">

        <link rel="stylesheet" href="../../styles/Global/Login.css">
    </head>
    <body>
        <section class="login-page">
            <div id="signup-form" class="signup-form">
                <h1 class="login-detail">Login</h1>
                <form action="../../backend/auth/loginprocess.php" class="input-form" method="POST">  
                    <div class="input-row">
                        <input type="text" placeholder="Username" name="username" maxlength="25" required>
                    </div>
                    <div class="input-row">
                        <input type="password" placeholder="Password" name="password" maxlength="25" required>
                    </div>
                    <div class="input-row">
                        <input type="submit" value="Login" name="login-btn">
                    </div>
                    <div class="login-link">
                        <a href="../auth/signup.php">Don't have an account? Signup</a>
                    </div>
                </form>
            </div>
        </section>
       
    </body>
</html>