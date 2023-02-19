<?php

require('../../backend/config.php');

session_start();

if(!$_SESSION['username'] == null) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../auth/login.php");
}

$orgid = $_GET['id'];

$getOrgInfo = "SELECT * FROM orgs WHERE id='$orgid'";
$result = $conn->query($getOrgInfo);

$getProjects = "SELECT * FROM projects WHERE orgID='$orgid'";
$getProjectsRes = $conn->query($getProjects);

$getOrgUser = "SELECT * FROM org_members WHERE orgMember='$username' AND orgID='$orgid'";
$getOrgUserRes = $conn->query($getOrgUser);

if(mysqli_num_rows($getOrgUserRes) == null) {
    header("Location: ../root/organization.php");
}
?>

<!DOCTYPE html>

<html>
    <?php
        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
    ?>
    <head>
        <title id="title"><?=htmlspecialchars($row['orgName'])?></title>

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
    <body class="blue body">
        <div class="topnav" id="myTopnav">
            <a href="../root/home.php">Home</a>
            <a href="../root/organization.php">Organizations</a>
            <a href="#">Tickets</a>
             <a href="../../backend/auth/logout.php">Logout</a>

            <a href="javascript:void(0);" class="icon" onclick="OpenCloseNav()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        
        <ul class="breadcrumbs">
            <li class="breadcrumbs-item">
                <a href="../root/organization.php?id=<?=$orgid?>" class="breadcrumbs-link">Your Organizations</a>
            </li>
            <li class="breadcrumbs-item">
                <a href="#" class="breadcrumbs-link"><?=htmlspecialchars($row['orgName'])?></a>
            </li>
        </ul>

        

        <div class="org-description">
            <p><?=$row['orgDesc']?></p>
        </div>

        <div class="option-bar">
            <div class="option-bar-item">
                <a title="Member Options" href="../assign/adduserorg.php?id=<?=$orgid?>"><i class="fa fas fa-users fa-lg option-icon"></i></a>
            </div>
            <div class="option-bar-item">
                <a title="Org Settings" href="../edit/orgsettings.php?id=<?=$orgid?>"><i class="fa fa-gear fa-lg option-icon"></i></a>
            </div>
        </div>


        <?php
            if(mysqli_num_rows($getProjectsRes) > 0) {
                ?>
                <div class="org-row">
                    <a class="create-org" href="../creation/createproject.php?orgid=<?=$orgid ?>">Create Project</a>
                </div>
                <div class="card-row">
                    <?php
                    while ($row1 = mysqli_fetch_array($getProjectsRes)) {
                        $projectid = $row1['id'];
                        ?>
                            <div class="card" onclick="location.href='../displays/projectdisplay.php?id=<?=$projectid?>&page=<?=1?>'">
                                <h3><?=htmlspecialchars($row1['projectName'])?></h3>
                            </div>
                        <?php
                    }
                    ?>
                    </div>
                    <?php
            } else {
                while ($row = mysqli_fetch_array($getOrgUserRes)) {
                    if($row['orgRole'] == "owner" || $row['orgRole'] == "editor") {

                ?>
                    <h4>This Org Does Not Have Any Projets <a class="link" href="../creation/createproject.php?orgid=<?=$orgid ?>">Create</a> One!</h4>
                <?php
                    }
                }
            }
        ?>
        <footer>
            <p class="footer-txt">@Camsdono Studios</p>
        </footer>
    </body>
    <?php
            }
        } else {
            header("Location: ../root/organization.php");
        }
    ?>
</html>
<script src="../../js/openCloseNavBar.js"></script>