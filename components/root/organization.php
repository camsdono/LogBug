<?php

require('../../backend/config.php');

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
    <title id="title">Organizations</title>

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

            <h2>Organizations</h2>

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