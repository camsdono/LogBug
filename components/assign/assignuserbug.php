<?php
 
require('../../backend/config.php');

session_start();

if(!$_SESSION['username'] == null) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../auth/login.php");
}

$bugID = $_GET['id'];


$getBug = "SELECT * FROM bugs WHERE id=$bugID";
$getBugRes = $conn->query($getBug); 

$bug = $getBugRes->fetch_assoc();
$projectID = $bug['projectID'];
$bugName = $bug['bugName'];

$getProject = "SELECT * FROM projects WHERE id=$projectID";
$getProjectRes = $conn->query($getProject);
$project = $getProjectRes->fetch_assoc();

$orgID = $project['orgID'];

$orgMembers = "SELECT * FROM org_members WHERE orgID=$orgID";
$orgMembersRes = $conn->query($orgMembers);



?>
<!DOCTYPE html>
<html>
<head>
        <title id="title">Assign User</title>

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

            <h2>Assign User To Bug</h2>
            <div class="back-button-holder">
                <div class="back-button" onclick="window.location = '../displays/bugdisplay.php?bugID=<?=$bugID?>'">
                    <h4 class="back-button-item">Back</h4>
                </div>
            </div>
            

            <form method="POST" action="../../backend/assignprocess/assignbugprocess.php">
                <div class="input-row">
                    <input type="hidden" name="bugID" value="<?=$bugID?>" require>
                </div>

                <div class="input-row">
                    <input type="hidden" name="bugName" value="<?=$bugName?>" require>
                </div>

                <div class="input-row">
                    <select name="members[]" multiple style="height: 10vh; font-size: 16px;" required>
                    <?php
                    while ($row1 = mysqli_fetch_array($orgMembersRes)) {

                        $username = $row1['orgMember'];

                        $checkBugMembers = "SELECT * FROM bug_members WHERE bugID='$bugID' AND username='$username'";
                        $checkBugMembersRes = $conn->query($checkBugMembers);
                        if(mysqli_num_rows($checkBugMembersRes) < 1) {
                           
                            echo "<option value='$username'>$username</option>";
                        }
                    }

                    if(mysqli_num_rows($checkBugMembersRes) > 0) { 
                        echo "<option value='$username' disabled>No users avaliable</option>";
                    }
                    
                    ?>
                    </select>
                </div>
                
                <div class="input-row">
                    <input type="submit" value="Assign" name="assign-btn">
                </div>
            </form>
        </section>
        <footer>
            <p class="footer-txt">@Camsdono Studios</p>
        </footer>
    </body>
</html>