<?php

require('../../backend/config.php');

session_start();

if($_SESSION['username'] != null) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../auth/login.php");
}

$getOrgInfo = "SELECT * FROM org_members WHERE orgMember='$username' AND confirmJoined=1";
$result = $conn->query($getOrgInfo);

$getPendingOrgs = "SELECT * FROM org_members WHERE orgMember='$username' AND confirmJoined=0";
$pendingOrgs = $conn->query($getPendingOrgs);

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


        <link rel="apple-touch-icon" sizes="180x180" href="../../images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon/favicon-16x16.png">
        <link rel="manifest" href="../../images/favicon/site.webmanifest">

        <link rel="stylesheet" href="../../styles/Global/Orgs.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <nav class="profile-nav">
            <div class="links">
                <a href="home.php">Home</a>
                <a href="./organization.php">Orgs</a>
            </div>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="profile-image" src="https://via.placeholder.com/35x35" alt="Profile Image">
                    <span class="profile-name"><?=htmlspecialchars($username)?></span>
                </button>
                <div class="dropdown-menu" id="menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a style="cursor: pointer;" id="color" class="dropdown-item color-select"></a>
                    <a class="dropdown-item" href="../../backend/auth/logout.php">Logout</a>
                </div>
            </div>
        </nav>
        <a href="javascript:void(0);" class="icon" onclick="OpenCloseNav()">
            <i class="fa fa-bars"></i>
        </a>

            <h2>Organizations</h2>
            <?php
            if(mysqli_num_rows($pendingOrgs) > 0) {
                ?>
                    <div class="pending-orgs">
                        <div class="pending-org-holder">
                            <div class="pending-org">
                                <!-- show the pending requests -->
                            </div>
                        </div>
                    </div>
                <?php
            }
            if(mysqli_num_rows($result) > 0) {
                ?>
                <div class="org-row">
                    <a class="create-org" href="../creation/createorg.php">Create Org</a>
                </div>
                <div class="card-row">
                    <?php
                while ($row = mysqli_fetch_array($result)) {
                    $orgID = $row["orgID"];
                    $getOrg = "SELECT * FROM orgs WHERE id='$orgID'";
                    $getOrgRes = $conn->query($getOrg);
                       
                    while ($row1 = $getOrgRes->fetch_row()) {
                       ?>
                           <div class="card" onclick="location.href='../displays/orgdisplay.php?id=<?=$orgID ?>'">
                                <h3><?=htmlspecialchars($row['orgName'])?></h3>
                           </div>
                       <?php
                    }
                }
                ?>
                </div>
                <?php
            } else {
                ?>
                <h4>You Are Currently Not In Any Orgs Either Join Or <a class="link" href="../creation/createorg.php">Create</a> One!</h4>
                <?php
            }

            ?>
    </body>
</html>
<script src="../../js/openCloseNavBar.js"></script>
<script>
    function showOrgs() {
        var x = document.getElementById("orgs");
        var y = document.getElementById("show-orgs");
        if (x.style.display === "none") {
            x.style.display = "block";
            y.innerHTML = "↑";
        } else {
            x.style.display = "none";
            y.innerHTML = "↓";
        }
    }
</script>
<script src="../../js/changeTheme.js"></script>