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

        <link rel="stylesheet" href="../../styles/styles.css" />
    </head>
    <body class="blue">
        
        <section>
            <h1 id="login-detail">Login</h1>
            <div id="login-form" class="login-form">
                <form action="../../backend/auth/loginprocess.php" method="POST">  
                    <div class="input-row">
                        <input type="text" placeholder="Username" name="username" required>
                    </div>
                    <div class="input-row">
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="input-row">
                        <input type="submit" value="Login" name="login-btn">
                    </div>
                </form>
            </div>

            <div id="signup-link">
                <p>Don't have an account? <a class="url"  href="signup.php">Signup</a></p>
            </div>
    
        <footer>
            <p class="footer-txt">@Camsdono Studios</p>
        </footer>
    </body>
</html>