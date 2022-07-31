<?php

session_start();

if(!$_SESSION['username'] == null) {
    $username = ucfirst($_SESSION['username']);
} else {
    header("Location: ../auth/login.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title id="title">Home</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1; user-scalable=0">
        <meta name="author" content="Camsdono Studios">
        <meta name="description" content="A better place to keep track of your bugs and manage teams">

        <link rel="stylesheet" href="../../styles/styles.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <section class="blue">
            <div class="curve"></div>
            <div class="topnav" id="myTopnav">
                <a href="./home.php">Home</a>
                <a href="./organization.php">Organizations</a>
                <a href="#">Tickets</a>

                <a href="javascript:void(0);" class="icon" onclick="OpenCloseNav()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <div class="welcome-message">
                <h2>Welcome <?=$username?></h2>
            </div>
            <div class="info-row">
                <h4 style="margin-left: 5px;">Stats:</h4>
                <div class="info">
                    <h5>Bugs Created:</h5>
                    <p></p>
                </div>
                <div class="info">
                    <h5>Projects In:</h5>
                    <p></p>
                </div>
                <div class="info">
                    <h5>Orgs In:</h5>
                    <p></p>
                </div>
            </div>
        </section>
        <footer>
            <p class="footer-txt">@Camsdono Studios</p>
        </footer>
    </body>
</html>
<script>  
    function OpenCloseNav() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>