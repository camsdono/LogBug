<?php

require('../../backend/config.php');

session_start();

$bugID = $_GET['bugID'];

$getBug = "SELECT * FROM bugs WHERE id=$bugID";
$getBugRes = $conn->query($getBug);

if(!$_SESSION['username'] == null) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../auth/login.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title id="title">BugDisplay</title>

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
            
            <?php
            
            if(mysqli_num_rows($getBugRes) > 0) {
                while ($row = mysqli_fetch_array($getBugRes)) {
                ?>
            
                <ul class="breadcrumbs">
                    <li class="breadcrumbs-item">
                        <a href="./projectdisplay.php?id=<?=$row['projectID']?>&page=1" class="breadcrumbs-link"><?=$row['projectName']?></a>
                    </li>
                    <li class="breadcrumbs-item">
                        <a href="#" class="breadcrumbs-link"><?=$row['bugName']?></a>
                    </li>
                </ul>
            
                <div class="org-description">
                    <p><?=$row['bugDesc']?></p>
                </div>
            
                <div class="due-date">
                    <?php
                        if($row['dueDate'] != null) {
                    ?>

                    <p>Due Date: <?=$row['dueDate']?></p>

                    <a href="../assign/assignuser.php?id=<?=$row['id']?>">Assign User</a>

                    <?php
                        }
                    ?>
                </div>
                
                <h3 class="members" style="margin-bottom: 0px;">Members:</h3>
                <div class="members">
                    <?php
                        $getMembers = "SELECT * FROM bug_members WHERE bugID=$bugID";
                        $getMembersRes = $conn->query($getMembers);
                        
                        if(mysqli_num_rows($getMembersRes) > 0) {
                            while ($row = mysqli_fetch_array($getMembersRes)) {
                    ?>
                                <p><?=$row['username']?></p>
                    <?php
                            }
                        }
                    ?>
                </div>
                <?php
            }
            }
            ?>

            
        </section>
        <footer>
            <p class="footer-txt">@Camsdono Studios</p>
        </footer>
    </body>
</html>
<script src="../../js/openCloseNavBar.js"></script>