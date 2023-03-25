<?php

require('../../backend/config.php');
require('../../backend/config.php');
require('../../backend/global/pfpmanager.php');

session_start();

if(!$_SESSION['username'] == null) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../auth/login.php");
}

$pfp = $_SESSION['pfp'];
$pfp = CheckPFP($pfp, $username); 

$orgid = $_GET['id'];

$getOrgInfo = "SELECT * FROM orgs WHERE id='$orgid'";
$result = $conn->query($getOrgInfo);

$getProjects = "SELECT * FROM projects WHERE orgID='$orgid'";
$getProjectsRes = $conn->query($getProjects);

$getOrgUser = "SELECT * FROM org_members WHERE orgMember='$username' AND orgID='$orgid'";
$getOrgUserRes = $conn->query($getOrgUser);

if(mysqli_num_rows($getOrgUserRes) == 0) {
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

        <link rel="stylesheet" href="../../styles/Global/OrgDisplay.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
   <body>
    <nav class="profile-nav">
            <div class="links">
                <a href="../root/home.php">Home</a>
                <a href="../root/organization.php">Orgs</a>
            </div>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="profile-image" width="35" height="35" src="<?=$pfp?>" alt="Profile Image">
                    <span class="profile-name"><?=htmlspecialchars($username)?></span>
                </button>
                <div class="dropdown-menu" id="menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a style="cursor: pointer;" id="color" class="dropdown-item color-select"></a>
                    <a class="dropdown-item" href="#">Support</a>
                    <a class="dropdown-item" href="../../backend/auth/logout.php">Logout</a>
                </div>
            </div>
        </nav>
        <a href="javascript:void(0);" class="icon" onclick="OpenCloseNav()">
            <i class="fa fa-bars"></i>
        </a>

        <div class="big-holder">
        <div class="org-information-holder">
            <div class="org-information">
                <div class="org-info">
                    <h1 class="org-name"><?=htmlspecialchars($row['orgName'])?></h1>
                    <p class="org-description"><?=htmlspecialchars($row['orgDesc'])?></p>
                </div>

              
            </div>
        </div>
        
        <div class="org-settings-holder">
        <div class="org-settings">
            <div class="org-option">
                <div class="org-option-button">Settings</div>
            </div>
            <div class="org-option">
                <div href="" class="org-option-button">Members</div>
            </div>
        </div>
        </div>
       
        </div>

       
        
        <div class="projects-holder">
            <div class="projects">
                <div class="projects-list">
                    <?php
                        if(mysqli_num_rows($getProjectsRes) > 0) {
                            while ($row = mysqli_fetch_array($getProjectsRes)) {
                    ?>
                     <div class="projects-header">
                        <h1 class="projects-title">Projects</h1>
                    </div>
                    <div class="project">
                        <div class="project-info">
                            <h1 class="project-name"><?=htmlspecialchars($row['projectName'])?></h1>
                            <p class="project-description"><?=htmlspecialchars($row['projectDesc'])?></p>
                        </div>
                        <div class="project-buttons">
                            <a href="project.php?id=<?=$row['id']?>" class="project-button">View</a>
                        </div>
                    </div>
                    <?php
                            }
                        } else {
                    ?>
                    <div class="project">
                        <div class="project-info">
                            <h1 class="project-name">No Projects</h1>
                            <p class="project-description">You have no projects in this organization.</p>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>


        <div class="fixedButton" title="Create Project">
            <div class="roundedFixedBtn"><i class="fa fa-plus"></i></div>
        </div>

   </body>
    <?php
            }
        } else {
            header("Location: ../root/organization.php");
        }
    ?>
</html>
<script src="../../js/openCloseNavBar.js"></script>
<script src="../../js/changeTheme.js"></script>