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

?>
<!DOCTYPE html>
<html>
    <head>
        <title id="title">Org Settings</title>

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
                    <a href="../root/organization.php?id=<?=$orgID?>" class="breadcrumbs-link"><?=$orgName?></a>
                </li>
                <li class="breadcrumbs-item">
                    <a href="#" class="breadcrumbs-link">Org Settings</a>
                </li>
            </ul>

            <h2>Org Settings</h2>

            <h3 style="width: 100%; margin-left: 15px;">General:</h3>

            <div class="settings">
                <form method="POST" action="../../backend/editprocess/orgsettings/orgnameeditprocess.php">
                    <div class="input-row">
                        <p>Organization Name: </p>
                    </div>
                    <div class="input-row">
                        <input type="text" name="orgname" placeholder="<?=$orgName?>" />
                    </div>
                    <div class="input-row">
                        <input type="hidden" name="orgid" value="<?=$orgId?>" />
                    </div>
                    <div class="input-row">
                        <input type="submit" value="Rename"  name="org-edit-name-btn"/>
                    </div>
                </form>

                <form method="POST" action="../../backend/editprocess/orgsettings/orgdesceditprocess.php">
                    <div class="input-row">
                        <p>Organization Description: </p>
                    </div>
                    <div class="input-row">
                        <input name="orgdesc" type="text" placeholder="<?=$orgDesc?>" />
                    </div>
                    <div class="input-row">
                        <input type="hidden" name="orgid" value="<?=$orgId?>" />
                    </div>
                    <div class="input-row">
                        <input type="submit" value="Update" name="org-edit-desc-btn" />
                    </div>
                </form>
            </div>
        <footer>
            <p class="footer-txt">@Camsdono Studios</p>
        </footer>
    </body>
</html>
<script src="../../js/openCloseNavBar.js"></script>