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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                <div class="org-option" id="project-button">
                    <div  class="org-option-button">Projects</div>
                </div>
                <div class="org-option" id="settings-button">
                    <div  class="org-option-button">Settings</div>
                </div>
                <div class="org-option" id="members-button">
                    <div  class="org-option-button">Members</div>
                </div>
            </div>
        </div>

       
        
        <div class="projects-holder" id="project-holder">
            <div class="projects">
                <div class="projects-list">
                    <?php
                        if(mysqli_num_rows($getProjectsRes) > 0) {
                            ?>
                            <div class="projects-header">
                                <h1 class="projects-title">Projects</h1>
                            </div>
                            <?php
                            while ($row = mysqli_fetch_array($getProjectsRes)) {
                    ?>
                     
                    <div class="project">
                        <div class="project-info">
                            <h1 class="project-name"><?=htmlspecialchars($row['projectName'])?></h1>
                            <p class="project-description"><?=htmlspecialchars($row['projectDesc'])?></p>
                        </div>
                        <div class="project-buttons">
                            <div class="setting-option-button"> View </div>
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

        <div class="settings-holder" id="settings-holder">
            <div class="settings">
                <div class="settings-list">
                    <div class="settings-header">
                        <h1 class="settings-title">Settings</h1>
                    </div>
                    <div class="settings-option">
                        <div class="settings-option-info">
                            <h1 class="settings-option-name">Organization Name</h1>
                            <p class="settings-option-description">Change the name of your organization.</p>
                        </div>
                        <div class="settings-option-buttons">
                            <div class="setting-option-button">Change</div>
                        </div>
                    </div>
                    <div class="settings-option">
                        <div class="settings-option-info">
                            <h1 class="settings-option-name">Organization Description</h1>
                            <p class="settings-option-description">Change the description of your organization.</p>
                        </div>
                        <div class="settings-option-buttons">
                            <div class="setting-option-button">Change</div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="members-holder" id="members-holder">
            <div class="members">
                <div class="members-list">
                    <div class="members-header">
                        <h1 class="members-title">Members</h1>
                    </div>
                    <?php
                        if(mysqli_num_rows($getOrgUserRes) > 0) {
                            while ($row = mysqli_fetch_array($getOrgUserRes)) {
                                $username1 = $row['orgMember'];
                                $getPfp1 = "SELECT * FROM users WHERE username='$username1'";
                                $getPfp1Res = mysqli_query($conn, $getPfp1);
                                $row = mysqli_fetch_array($getPfp1Res);
                                $pfp1 = $row['pfp'];
                                $pfp1 = CheckPFP($pfp1, $username1);

                                // Get org member info
                                $getOrgMemberInfo = "SELECT * FROM org_members WHERE orgMember='$username1'";
                                $getOrgMemberInfoRes = mysqli_query($conn, $getOrgMemberInfo);
                                $row = mysqli_fetch_array($getOrgMemberInfoRes);
                    ?>
                    <div class="member">
                        <div class="member-info">
                            <img class="profile-image" width="35" height="35" src="<?=$pfp1?>" alt="Profile Image">
                            <h1 class="member-name"><?=$username1?></h1>
                        </div>
                        <div class="member-buttons" onclick="showModal(<?=$row['memberID']?>, <?=$row['orgID']?>)">
                            <div class="member-button" >View</div>
                        </div>
                        <div class="member-buttons" style="margin-left: 20px;" onclick="ManageMemberPopup(<?=$row['memberID']?>, <?=$row['orgID']?>)">

                            <div class="member-button" >Manage</div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

        <pop-up id="modal-container" style="display: none;">
            <div class="innerModal" id="modal" >
            <div class="fixedHolder">
                <table>
                    <tr>
                        <td>
                            <div class="innerModalHolder" id="" style="max-width: 400px;">
                                <div class="innerHeader">
                                <div class="close-button" id="close-member-button">x</div>
                                    <div class="innerTitle">
                                        Member Information
                                    </div>
                                </div>
                                <div class="innerContent">
                                    <div class="modal-content-text" id="modal-content-text">
                                        
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        </pop-up>
        

         <pop-up id="create-project-window" style="display: none;">
            <div class="innerModal" id="modal" >
            <div class="fixedHolder">
                <table>
                    <tr>
                        <td>
                            <div class="innerModalHolder" id="" style="max-width: 400px;">
                                <div class="innerHeader">
                                <div class="close-button" id="close-project-button">x</div>
                                    <div class="innerTitle">
                                        Create Project
                                    </div>
                                </div>
                                <div class="innerContent">
                                    <form method="POST" action="../../backend/createprocesses/createprojectprocess.php">
                                        <div class="input-row">
                                            <input type="text" placeholder="Project Name" maxlength="20" minlength="3" name="projectName" required>
                                        </div>
                                        <div class="input-row">
                                            <input type="text" placeholder="Project Description" maxlength="35" minlength="3" name="projectDesc" required>
                                        </div>
                                        <div class="input-row">
                                            <input type="hidden" name="orgID" value="<?=$orgid?>">
                                        </div>
                                        <div class="input-row">
                                            <input type="submit" value="Create Project" name="create-project-btn">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        </pop-up>

        <pop-up id="manage-member-popup" style="display: none;">
            <div class="innerModal" id="modal" >
            <div class="fixedHolder">
                <table>
                    <tr>
                        <td>
                            <div class="innerModalHolder" id="" style="max-width: 400px;">
                                <div class="innerHeader">
                                <div class="close-button" id="close-manage-member-button">x</div>
                                    <div class="innerTitle">
                                        Manage Member
                                    </div>
                                </div>
                                <div class="innerContent">
                                    <div class="modal-content-text" id="modal-content-text">
                                        
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        </pop-up>
        

         <pop-up id="create-project-window" style="display: none;">
            <div class="innerModal" id="modal" >
            <div class="fixedHolder">
                <table>
                    <tr>
                        <td>
                            <div class="innerModalHolder" id="" style="max-width: 400px;">
                                <div class="innerHeader">
                                <div class="close-button" id="close-project-button">x</div>
                                    <div class="innerTitle">
                                        Create Project
                                    </div>
                                </div>
                                <div class="innerContent">
                                    <form method="POST" action="../../backend/createprocesses/createprojectprocess.php">
                                        <div class="input-row">
                                            <input type="text" placeholder="Project Name" maxlength="20" minlength="3" name="projectName" required>
                                        </div>
                                        <div class="input-row">
                                            <input type="text" placeholder="Project Description" maxlength="35" minlength="3" name="projectDesc" required>
                                        </div>
                                        <div class="input-row">
                                            <input type="hidden" name="orgID" value="<?=$orgid?>">
                                        </div>
                                        <div class="input-row">
                                            <input type="submit" value="Create Project" name="create-project-btn">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        </pop-up>
         <pop-up id="create-project-window" style="display: none;">
            <div class="innerModal" id="modal" >
            <div class="fixedHolder">
                <table>
                    <tr>
                        <td>
                            <div class="innerModalHolder" id="" style="max-width: 400px;">
                                <div class="innerHeader">
                                <div class="close-button" id="close-project-button">x</div>
                                    <div class="innerTitle">
                                        Create Project
                                    </div>
                                </div>
                                <div class="innerContent">
                                    <form method="POST" action="../../backend/createprocesses/createprojectprocess.php">
                                        <div class="input-row">
                                            <input type="text" placeholder="Project Name" maxlength="20" minlength="3" name="projectName" required>
                                        </div>
                                        <div class="input-row">
                                            <input type="text" placeholder="Project Description" maxlength="35" minlength="3" name="projectDesc" required>
                                        </div>
                                        <div class="input-row">
                                            <input type="hidden" name="orgID" value="<?=$orgid?>">
                                        </div>
                                        <div class="input-row">
                                            <input type="submit" value="Create Project" name="create-project-btn">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        </pop-up>

        <div class="fixedButton" title="Create Project" id="create-project">
            <div  class="roundedFixedBtn"><i class="fa fa-plus"></i></div>
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
<script src="../../js/displays/orgDisplay.js"></script>