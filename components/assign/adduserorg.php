<?php

require('../../backend/config.php');

session_start();

if(!$_SESSION['username'] == null) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../auth/login.php");
}

$orgID = $_GET['id'];

$orgInfo = "SELECT * FROM orgs WHERE id='$orgID'";
$orgInfoRes = $conn->query($orgInfo);
$orgInfoRow = mysqli_fetch_array($orgInfoRes);

$orgName = $orgInfoRow['orgName'];
$orgDesc = $orgInfoRow['orgDesc'];
$orgId = $orgInfoRow['id'];

$orgMembers = "SELECT * FROM org_members WHERE orgID='$orgID'";
$orgMembersRes = $conn->query($orgMembers);

?>

<!DOCTYPE html>
<html>
    <head>
        <title id="title">Org Users</title>

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

            <a href="javascript:void(0);" class="icon" onclick="OpenCloseNav()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        
        <ul class="breadcrumbs">
            <li class="breadcrumbs-item">
                <a href="../root/organization.php?id=<?=$orgId?>" class="breadcrumbs-link">Your Organizations</a>
            </li>
            <li class="breadcrumbs-item">
                <a href="../displays/orgdisplay.php?id=<?=$orgId?>" class="breadcrumbs-link"><?=$orgName?></a>
            </li>
        </ul>

        <h2>Org User Settings</h2>

        <h3 style="width: 100%; margin-left: 15px;">Assign Users:</h3>

        <div class="settings">
            <form method="POST" action="../../backend/assignprocess/adduserorgprocess.php">
                <div class="input-row">
                    <input type="text" name="username" placeholder="Username" />
                </div>
                <label for="userrole">User Role:</label>
                <div class="input-row">
                    <select name="userRole" id="priority" require>
                        <option value="member">Member</option>
                        <option value="editor">Editor</option>
                        <option value="owner">Owner</option>
                    </select>
                </div>
                <div class="input-row">
                    <input type="hidden" name="orgid" value="<?=$orgId?>" />
                </div>
                <div class="input-row">
                    <input type="hidden" name="orgname" value="<?=$orgName?>" />
                </div>
                <div class="input-row">
                    <input type="submit" value="Add User"  name="org-assign-user-btn"/>
                </div>
            </form>
        </div>

        <h3 style="width: 100%; margin-left: 15px;">Org Users:</h3>
        <?php while($orgMembersRow = mysqli_fetch_array($orgMembersRes)) { ?>
        <div class="org-members">
           
            <div class="item">
                <?php echo $orgMembersRow['orgMember']; ?>
            </div>
                <div class="item">
                    <div class="button button-small button-assertive"> 
                        <div class="input-row remove-btn">
                            <form method="POST" action="../../backend/deleteprocess/removeuserorg.php">
                                <input type="hidden" name="orgMember" value="<?=$orgMembersRow['orgMember']; ?>" />
                                <input type="hidden" name="orgID" value="<?=$orgID; ?>" />
                                <input type="submit" value="Remove User"  name="org-remove-user-btn"/>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <?php } ?>
    </body>
    <footer>
        <p class="footer-txt">@Camsdono Studios</p>
    </footer>
</html>
<script src="../../js/openCloseNavBar.js"></script>