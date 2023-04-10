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
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
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
                <div class="org-option" id="project-button">
                    <div  class="org-option-button">Bugs</div>
                </div>
                <div class="org-option" id="settings-button">
                    <div  class="org-option-button">Settings</div>
                </div>
            </div>
        </div>

       
   </body>
</html>
<?php } else { ?>
            <h1>Project not found</h1>
        <?php } ?>
<script src="../../js/openCloseNavBar.js"></script>
<script src="../../js/changeTheme.js"></script>