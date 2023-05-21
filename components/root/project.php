<?php

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
$projectID = $_GET['projectID'];

// get project information from database
$getProjects = "SELECT * FROM projects WHERE id='$projectID'";
$getProjectsRes = $conn->query($getProjects);

$getBugs = "SELECT * FROM bugs WHERE projectID='$projectID'";
$getBugsRes = $conn->query($getBugs);


// get userID 
$getUserID = "SELECT * FROM users WHERE username='$username'";
$getUserIDRes = $conn->query($getUserID);

if (mysqli_num_rows($getUserIDRes) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($getUserIDRes)) {
        $userID = $row['id'];
    }
}

// get org role 
$getOrgRole = "SELECT * FROM org_members WHERE memberID='$userID'";
$getOrgRoleRes = $conn->query($getOrgRole);

if (mysqli_num_rows($getOrgRoleRes) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($getOrgRoleRes)) {
        $orgRole = $row['orgRole'];
        $orgID = $row['orgID'];
    }
}


?>
<?php 
        if (mysqli_num_rows($getProjectsRes) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($getProjectsRes)) {
                $projectName = $row['projectName'];
                $projectDescription = $row['projectDesc'];
            }
        ?>
<!DOCTYPE html>
<html>
    <head>

        <title id="title"><?=htmlspecialchars($projectName)?></title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1; user-scalable=0">
        <meta name="author" content="Camsdono Studios">
        <meta name="description" content="A better place to keep track of your bugs and manage teams">

        <link rel="apple-touch-icon" sizes="180x180" href="../../images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon/favicon-16x16.png">
        <link rel="manifest" href="../../images/favicon/site.webmanifest">

        <link rel="stylesheet" href="../../styles/Global/Project.css" />
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
                    <a class="dropdown-item" href="../global/comingsoon.html">Profile</a>
                    <a class="dropdown-item" href="../global/comingsoon.html">Settings</a>
                    <a hidden style="cursor: pointer;" id="color" class="dropdown-item color-select"></a>
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
                    <h1 class="org-name"><?=htmlspecialchars($projectName)?></h1>
                    <p class="org-description"><?=htmlspecialchars($projectDescription)?></p>
                </div>
            </div>
        </div>
        
        <div class="org-settings-holder">
            <div class="org-settings">
                <div class="org-option" id="bugs-button" onclick="OpenProjectBugs()">
                    <div class="org-option-button" >Bugs</div>
                </div>
                <div class="org-option" id="settings-button"  onclick="OpenProjectSettings()">
                    <div  class="org-option-button">Settings</div>
                </div>
            </div>
        </div>

       <div class="bugs-holder" id="project-bugs-popup">
            <div class="bugs">
                <div class="bugs-list">
                    <?php 
                    if (mysqli_num_rows($getBugsRes) > 0) {
                        // get each bug
                        while ($row1 =  mysqli_fetch_assoc($getBugsRes)) {
                          $bugID = $row1['id'];
                          $bugPriority = $row1['priority'];
                          $bugName = $row1['bugName'];
                          $bugDesc = $row1['bugDesc'];
                          if ($row1['closedBug'] == 0) {
                                $closedBug = "Open";
                            } else {
                                $closedBug = "Closed";
                            }
                            ?>
                           
                             <div class="project">
                                <div class="project-info">
                                    <h1 class="project-name" title="<?=htmlspecialchars($row1['bugName'])?>"><?=htmlspecialchars($row1['bugName'])?></h1>
                                    <p class="project-description" title="<?=htmlspecialchars($row1['bugDesc'])?>"><?=htmlspecialchars($row1['bugDesc'])?></p>
                                </div>
                                <div class="project-buttons">
                                    <div class="setting-option-button" onclick="OpenBug(<?=$row1['id']?>)">View</div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="no-bugs">
                            <h2>No Bugs Found.</h2s>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
       </div>

       <!-- Actual settings page -->
       <div class="bugs-holder" id="project-settings-page" style="display: none;">
            <div class="bugs">
            <div class="settings-page" id="settings-page">
                    <div class="settings">
                        <div class="settings-list">
                            <div class="settings-header">
                                <h1 class="settings-title">Project Settings</h1>
                            </div>
                            <?php
                            if ($orgRole == "owner" || $orgRole == "editor") {
                                ?>
                                <div class="settings-option">
                                    <div class="settings-option-info">
                                        <h1 class="settings-option-name" style="color: red; width: 10vw;">Delete Project</h1>
                                        <p class="settings-option-description">Delete Project.</p>
                                    </div>
                                    <div class="settings-option-buttons">
                                        <div class="setting-option-button" onclick="OpenDeleteProject()" id="delete-bug-btn">Delete</div>
                                    </div>
                                </div>

                                <pop-up id="delete-project-popup" style="display: none;">
                                    <div class="innerModal" id="modal" >
                                    <div class="fixedHolder">
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="innerModalHolder" id="" style="max-width: 400px;">
                                                        <div class="innerHeader">
                                                        <div class="close-button"  onclick="CancelDeleteProject()" id="close-delete-org-button">x</div>
                                                            <div class="innerTitle">
                                                                Delete Project
                                                            </div>
                                                        </div>
                                                        <div class="innerContent">
                                                            <div class="modal-content-text">
                                                                <p> Are you sure you want to delete this project? </p>
                                                            </div>
                                                            <div class="modal-content-buttons">
                                                                <div class="modal-content-button" onclick="DeleteProject(<?=$projectID?>, <?=$orgID?>)" id="confirm-delete-org-btn">Delete</div>

                                                                <div class="modal-content-button"  onclick="CancelDeleteProject()" id="cancel-delete-org-btn">Cancel</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                </pop-up>
                                <?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <pop-up id="bug-display-popup" style="display: none;">
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <h2 class="popup-title" id="bug-title"></h2>
                    <div class="view-member-row" id="button-holder" style="display: none;">
                        <div class="view-members">
                            <div class="view-members-button" id="general-btn">General</div>
                        </div>
                        <div class="view-members">
                            <div class="view-members-button" id="members-btn">Members</div>
                        </div>
                        <!--
                        <div class="view-members">
                            <div class="view-members-button">Comments</div>
                        </div>
                        -->

                        <div class="view-members" id="bug-settings">
                            <div class="view-members-button">Settings</div>
                        </div>
                    </div>

                    <div class="general-page" id="general-page">
                        <p class="bugstatus" id="bug-status"></p>
                        <p class="bugdesc" id="bug-description"></p>
                        <p class="bugpriority" id="bug-priority"></p>
                    </div>

                    <div class="member-page" id="members-page" style="display: none;">
                        <div class="asign-member-popup" style="width: 50%;">
                            <div class="input-holder">
                                <input type="text" id="assign-user-input" placeholder="Username Or Email">
                                <div class="button"  onclick="assignUserBug(<?=$bugID?>)">
                                    <div class="button-text">Assign</div>
                                </div>
                            </div>
                        </div>
                        <div class="members-list" id="members-list">
                            <?php 
                                // get each member from bug_members
                                $getBugmembers = "SELECT * FROM bug_members WHERE bugID='$bugID'";
                                $getBugMemRes = $conn->query($getBugmembers);

                                // get each member
                                while ($row2 =  mysqli_fetch_assoc($getBugMemRes)) {
                                    $userID = $row2['userID'];
                                    $getMember = "SELECT * FROM users WHERE id='$userID'";
                                    $getMemberRes = $conn->query($getMember);

                                    $row3 = mysqli_fetch_assoc($getMemberRes);
                                    ?>
                                    <div class="member">
                                        <img class="member-image" width="35" height="35" src="<?=$row3['pfp']?>" alt="Profile Image">
                                        <p class="member-name"><?=htmlspecialchars($row3['username'])?></p>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>

                    <div class="settings-page" id="settings-page" style="display: none;">
                        <div class="settings">
                            <div class="settings-list">
                                <div class="settings-header">
                                    <h1 class="settings-title">Settings</h1>
                                </div>
                                <div class="settings-option">
                                    <div class="settings-option-info">
                                        <h1 class="settings-option-name" >Open/Close Bug</h1>
                                        <p class="settings-option-description">Open Or Close Bug.</p>
                                    </div>
                                    <?php 
                                    if ($closedBug == "Closed") {
                                        ?>
                                            <div class="settings-option-buttons" onclick="CloseOpenBug(1, <?=$bugID?>)">
                                                <div class="setting-option-button" id="delete-bug-btn">Open</div>
                                            </div>
                                        <?php
                                    } 

                                    if ($closedBug == "Open") {
                                        ?>
                                            <div class="settings-option-buttons" onclick="CloseOpenBug(0, <?=$bugID?>)">
                                                <div class="setting-option-button" id="delete-bug-btn">Close</div>
                                            </div>
                                        <?php
                                    } ?>
                                    
                                </div>

                                <div class="settings-option">
                                    <div class="settings-option-info">
                                        <h1 class="settings-option-name" >Update Priority</h1>
                                        <p class="settings-option-description">Update The Bug Priority Level.</p>
                                    </div>
                                    <div class="settings-option-buttons">
                                        <div class="setting-option-button" onclick="OpenUpdatePriorityPopUp()" id="update-bug-priorty-btn">Update</div>
                                    </div>
                                </div>
                                <?php
                                if ($orgRole == "owner" || $orgRole == "editor") {
                                    ?>
                                    <div class="settings-option">
                                        <div class="settings-option-info">
                                            <h1 class="settings-option-name">Change Name</h1>
                                            <p class="settings-option-description">Change Name Of Bug.</p>
                                        </div>
                                        <div class="settings-option-buttons">
                                            <div class="setting-option-button" onclick="UpdateNameOpen()" id="change-name-btn">Change</div>
                                        </div>
                                    </div>
                                    <div class="settings-option">
                                        <div class="settings-option-info">
                                            <h1 class="settings-option-name">Change Descripton</h1>
                                            <p class="settings-option-description">Change Description Of Bug.</p>
                                        </div>
                                        <div class="settings-option-buttons">
                                            <div class="setting-option-button" onclick="UpdateDescriptionOpen()" id="change-desc-btn">Change</div>
                                        </div>
                                    </div>
                                    <div class="settings-option">
                                        <div class="settings-option-info">
                                            <h1 class="settings-option-name" style="color: red;">Delete Bug</h1>
                                            <p class="settings-option-description">Delete Bug From Project.</p>
                                        </div>
                                        <div class="settings-option-buttons">
                                            <div class="setting-option-button" onclick="OpenDeleteBug()" id="delete-bug-btn">Delete</div>
                                        </div>
                                    </div>
                                    <?php
                                } ?>
                                

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
      </div> 
                </div>
            </div>
        </pop-up>

        <pop-up id="update-bug-priorty-popup" style="display: none;">
            <div class="innerModal" id="modal" >
            <div class="fixedHolder">
                
                <table>
                    <tr>
                        <td>
                            <div class="innerModalHolder" id="" style="max-width: 400px;">
                                <div class="innerHeader">
                                <div class="close-button" onclick="CloseUpdatePriorityPopUp()">x</div>
                                    <div class="innerTitle">
                                        Update Bug Priority
                                    </div>
                                </div>
                                <div class="innerContent">
                                    <form method="POST" action="../../backend/editprocess/bugsettings/bugpriorityedit.php">
                                        <div class="input-row">
                                            <input type="text" placeholder="Bug Prioirty..." maxlength="10" minlength="3" name="bugPriority" required>
                                        </div>

                                        <div class="input-row">
                                            <input type="hidden" name="bugID" value="<?=$bugID?>" hidden>
                                        </div>
                                        
                                        <div class="input-row">
                                            <input type="submit" value="Update Priority" name="update-bug-priority-btn">
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

        <?php 

            if ($orgRole == "owner" || $orgRole == "editor") {
                ?>
                <pop-up id="update-bug-name-popup" style="display: none;">
                    <div class="innerModal" id="modal" >
                    <div class="fixedHolder">
                        <table>
                            <tr>
                                <td>
                                    <div class="innerModalHolder" id="" style="max-width: 400px;">
                                        <div class="innerHeader">
                                        <div class="close-button" onclick="UpdateNameClose()">x</div>
                                            <div class="innerTitle">
                                                Update Bug Name
                                            </div>
                                        </div>
                                        <div class="innerContent">
                                            <form method="POST" action="../../backend/editprocess/bugsettings/bugnameedit.php">
                                                <div class="input-row">
                                                    <input type="text" placeholder="<?=$bugName?>" maxlength="20" minlength="3" name="bugName" required>
                                                </div>
                                                <div class="input-row">
                                                    <input type="hidden" name="bugID" value="<?=$bugID?>" hidden>
                                                </div>
                                                
                                                <div class="input-row">
                                                    <input type="submit" value="Update Name" name="update-bug-name-btn">
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

                <pop-up id="update-bug-desc-popup" style="display: none;">
                    <div class="innerModal" id="modal" >
                    <div class="fixedHolder">
                        <table>
                            <tr>
                                <td>
                                    <div class="innerModalHolder" id="" style="max-width: 400px;">
                                        <div class="innerHeader">
                                        <div class="close-button" onclick="UpdateDescriptionClose()">x</div>
                                            <div class="innerTitle">
                                                Update Bug Description
                                            </div>
                                        </div>
                                        <div class="innerContent">
                                            <form method="POST" action="../../backend/editprocess/bugsettings/bugdescedit.php">
                                                <div class="input-row">
                                                    <input type="text" placeholder="<?=$bugDesc?>" maxlength="20" minlength="3" name="bugDesc" required>
                                                </div>
                                                <div class="input-row">
                                                    <input type="hidden" name="bugID" value="<?=$bugID?>" hidden>
                                                </div>
                                                
                                                <div class="input-row">
                                                    <input type="submit" value="Update Description" name="update-bug-desc-btn">
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
                 <pop-up id="delete-bug-popup" style="display: none;">
                    <div class="innerModal" id="modal" >
                    <div class="fixedHolder">
                        <table>
                            <tr>
                                <td>
                                    <div class="innerModalHolder" id="" style="max-width: 400px;">
                                        <div class="innerHeader">
                                        <div class="close-button"  onclick="CancelDeleteBug()" id="close-delete-org-button">x</div>
                                            <div class="innerTitle">
                                                Delete Bug
                                            </div>
                                        </div>
                                        <div class="innerContent">
                                            <div class="modal-content-text">
                                                <p> Are you sure you want to delete this bug? </p>
                                            </div>
                                            <div class="modal-content-buttons">
                                                <div class="modal-content-button" onclick="DeleteBug(<?=$bugID?>, <?=$userID?>)" id="confirm-delete-org-btn">Delete</div>

                                                <div class="modal-content-button"  onclick="CancelDeleteBug()" id="cancel-delete-org-btn">Cancel</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                </pop-up>
                <?php
            }

            if ($orgRole == 'member' || $orgRole == 'editor' || $orgRole == 'owner') {
                ?>

                <div class="fixedButton" onclick="CreateBugOpen()" title="Create Bug" id="create-bug">
                    <div  class="roundedFixedBtn"><i class="fa fa-plus"></i></div>
                </div>

                <pop-up id="create-bug-popup" style="display: none;">
                    <div class="innerModal" id="modal" >
                    <div class="fixedHolder">
                        <table>
                            <tr>
                                <td>
                                    <div class="innerModalHolder" id="" style="max-width: 400px;">
                                        <div class="innerHeader">
                                        <div class="close-button" onclick="CreateBugClose()">x</div>
                                            <div class="innerTitle">
                                                Add Bug
                                            </div>
                                        </div>
                                        <div class="innerContent">
                                            <form method="POST" action="../../backend/createprocesses/createbugprocess.php">
                                                <div class="input-row">
                                                    <input type="text" placeholder="Bug Name..." maxlength="20" minlength="3" name="bugName" required>
                                                </div>
                                                <div class="input-row">
                                                    <input type="text" placeholder="Bug Description..." maxlength="20" minlength="3" name="bugDesc" required>
                                                </div>

                                                <div class="input-row">
                                                    <input type="text" placeholder="Bug Prioirty..." maxlength="10" minlength="3" name="bugPriority" required>
                                                </div>

                                                <div class="input-row">
                                                    <input type="hidden" value="<?=$projectID?>" name="projectID" hidden class="extra-input" onkeydown="return false">
                                                </div>

                                                <div class="input-row">
                                                    <input type="hidden" value="<?=$projectName?>" name="projectName" hidden class="extra-input"  onkeydown="return false">
                                                </div>

                                                <div class="input-row">
                                                    <input type="hidden" value="<?=$username?>" name="username" hidden class="extra-input"  onkeydown="return false">
                                                </div>
                                                
                                                
                                                <div class="input-row">
                                                    <input type="submit" value="Add Bug" name="add-bug-btn">
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

                

                <?php
            }
        ?> 

       
   </body>
</html>
<?php } else { ?>
            <h1>Project not found</h1>
        <?php } ?>
<script src="../../js/openCloseNavBar.js"></script>
<script src="../../js/changeTheme.js"></script>
<script src="../../js/displays/projectDisplay.js"></script>