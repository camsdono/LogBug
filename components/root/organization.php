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
        <nav class="profile-nav" id="nav">
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
        <main id="main">
            <?php
            if(mysqli_num_rows($pendingOrgs) > 0) {
                ?>

                    <div class="pending-orgs">
                    <h2 class="pending-org-title">Pending Orgs:</h2>
                        <div class="pending-org-holder">
                       
                        <?php
                        // only show 3 pending orgs
                        $count = 0;
                        
                        while ($row = mysqli_fetch_array($pendingOrgs))  {$count += 1; ?>
                            <?php if($count > 3) { break; } ?>
                            <div class="pending-org">
                                <h3 class="orgName" title="Name: <?=htmlspecialchars($row['orgName'])?>"><?=htmlspecialchars($row['orgName'])?></h3>
                                <div class="pending-org-buttons">
                                    <a title="Accept Org" class="pending-org-button" href="../../backend/orgs/acceptorg.php?id=<?=$row['id']?>">Accept</a>
                                    <a title="Decline Org" class="pending-org-button" href="../../backend/orgs/declineorg.php?id=<?=$row['id']?>">Decline</a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php
            }
            if(mysqli_num_rows($result) > 0) {
                ?>
                <div class="create-org-button-holder">
                    <div class="create-org-button" id="org-create">
                        <a  class="create-org-btn" >Create Org</a>
                    </div>
                </div>
               
                <div class="org-holder">
                    <?php
                    while ($row = mysqli_fetch_array($result))  {
                        ?>
                        <div class="org">
                            <h3 class="orgName" title="Name: <?=htmlspecialchars($row['orgName'])?>"><?=htmlspecialchars($row['orgName'])?></h3>
                        </div>
                        <?php } ?>
                </div>
                <?php
            } else {
                ?>
                <h4>You Are Currently Not In Any Orgs Either Join Or <a class="link" href="../creation/createorg.php">Create</a> One!</h4>
                <?php
            }
            ?>
        </main>
        
        <pop-up id="pop-up" style="display: none;">
            <div class="innerModal" id="modal" >
            <div class="fixedHolder">
                
                <table>
                    <tr>
                        <td>
                            <div class="innerModalHolder" id="" style="max-width: 400px;">
                                <div class="innerHeader">
                                <div class="close-button">x</div>
                                    <div class="innerTitle">
                                        Create Organization
                                    </div>
                                </div>
                                <div class="innerContent">
                                    <form method="POST" action="../../backend/createprocesses/createorgprocess.php">
                                        <div class="input-row">
                                            <input type="text" placeholder="Org Name" maxlength="20" minlength="3" name="orgName" required>
                                        </div>
                                        <div class="input-row">
                                            <input type="text" placeholder="Org Description" maxlength="35" minlength="3" name="orgDesc" required>
                                        </div>
                                        <div class="input-row">
                                            <input type="submit" value="Create Organization" name="create-org-btn">
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
    </body>
</html>

<script src="../../js/displays/createorgDisplay.js"></script>
<script src="../../js/openCloseNavBar.js"></script>
<script src="../../js/changeTheme.js"></script>