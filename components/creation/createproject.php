<?php

require('../../backend/config.php');

session_start();

if(!$_SESSION['username'] == null) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../auth/login.php");
}

$orgid = $_GET['orgid'];

?>

<!DOCTYPE html>
<html>

    <head>
        <title id="title">Create Project</title>

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
                <a href="../root/home.php">Home</a>
                <a href="../root/organization.php">Organizations</a>
                <a href="#">Tickets</a>

                <a href="javascript:void(0);" class="icon" onclick="OpenCloseNav()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>

            <h2>Create Project</h2>

            <form method="POST" action="../../backend/createprocesses/createprojectprocess.php">
                <div class="input-row">
                    <input type="text" placeholder="Project Name" name="projectName" require>
                </div>
                <div class="input-row">
                    <input type="text" placeholder="Project Description" name="projectDesc" require>
                </div>
                <div class="input-row" style="display: none">
                    <input type="text" value="<?=$orgid?>" name="orgID" require>
                </div>
                <div class="input-row">
                    <input type="submit" value="Create Project" name="create-project-btn">
                </div>
            </form>
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