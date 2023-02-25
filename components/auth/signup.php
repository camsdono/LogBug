<?php
session_start();
$token = $_SESSION["token"] = md5(session_id().time());

if($token == null){
    exit();
} else {
    $start_time = microtime(true);
?>

<!DOCTYPE html>  
<html>
    <head>
        <title id="title">Signup</title>

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
            <h1 id="login-detail">Signup</h1>
            <div id="signup-form" class="signup-form">
                <form action="../../backend/auth/loginprocess.php" method="POST">  
                    <div class="input-row">
                        <input type="text" placeholder="Name" name="name" maxlength="25" required>
                    </div>
                    <div class="input-row">
                        <input type="email" placeholder="Email" name="email" maxlength="30" required>
                    </div>
                    <div class="input-row">
                        <input type="text" placeholder="Username" name="username" maxlength="25" required>
                    </div>
                    <div class="input-row">
                        <input type="password" placeholder="Password" name="password" maxlength="25" required>
                    </div>
                    <div class="input-row">
                        <input type="password" placeholder="Confirm Password" name="confirm-password" maxlength="25" required>
                    </div>
                    <div class="input-row">
                        <input type="hidden" name="start-time" value="<?=$start_time?>" onkeydown="return false;" style="pointer-events: none; display: none; ">
                    </div>
                    <div class="input-row" style="display: none;">
                        <input type="hidden" name="token" value="">
                    </div>
                    <div class="input-row">
                        <input type="submit" value="Register" name="register-btn">
                    </div>
                </form>
            </div>
            <p>Already have an account? <a class="url" href="../auth/login.php">Login</a></p>
        </section>
    
        <footer>
            <p class="footer-txt">@Camsdono Studios</p>
        </footer>
    </body>
</html>
<?php
}
?>