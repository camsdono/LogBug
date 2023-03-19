<?php
require('../../backend/config.php');

session_start();

if(!$_SESSION['username'] == null) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../auth/login.php");
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title id="title">Create Organization</title>

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body  class="blue">
        <section>
            <div class="topnav" id="myTopnav">
                <a href="../root/home.php">Home</a>
                <a href="../root/organization.php">Organizations</a>
                <a href="#">Tickets</a>
                <a href="../../backend/auth/logout.php">Logout</a>

                <a href="javascript:void(0);" class="icon" onclick="OpenCloseNav()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>

            <h2>Create Organization</h2>

            <form method="POST" action="../../backend/createprocesses/createorgprocess.php">
                <div class="input-row">
                    <input type="text" placeholder="Org Name" maxlength="20" name="orgName" require>
                </div>
                <div class="input-row">
                    <input type="text" placeholder="Org Description" maxlength="50" name="orgDesc" require>
                </div>
                <div class="input-row">
                    <input type="submit" value="Create Organization" name="create-org-btn">
                </div>
            </form>
            
            <div class="inner-footer"></div>
        </section>
        <footer>
            <p class="footer-txt">@Camsdono Studios</p>
        </footer>
    </body>
</html>
<script src="../../js/openCloseNavBar.js"></script>