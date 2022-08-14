<?php

    require('../../backend/config.php');

    session_start();

    if(!$_SESSION['username'] == null) {
        $username = $_SESSION['username'];
    } else {
        header("Location: ../auth/login.php");
    }

    $projectid = $_GET['id'];
    $getProjectInfo = "SELECT * FROM projects WHERE id='$projectid'";
    $result = $conn->query($getProjectInfo);

    $getBugs = "SELECT * FROM bugs WHERE projectID='$projectid'";
    $getBugsRes = $conn->query($getBugs);
    
?>

<!DOCTYPE html>
<html>
    <?php
        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
    ?>
    <head>
        <title id="title"><?=$row['projectName']?></title>

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

            <h2><?=$row['projectName']?></h2>
            <div class="org-description">
                <p><?=$row['projectDesc']?></p>
            </div>

            <?php

            if(mysqli_num_rows($getBugsRes) > 0) {
                ?>
                
                <?php
            } else {
                ?>
                    <h4>There Are No Bugs Currently In The Project Would You Like To <a class="link" href="../creation/createorg.php">Add</a> One!</h4>
                <?php
            }

            ?>
        </section>
    </body>
    <?php
            }
        } else {
            header("Location: ../root/organization.php");
        }
    ?>
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