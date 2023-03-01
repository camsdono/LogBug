<?php

require('../../backend/config.php');

session_start();

if(!$_SESSION['username'] == null) {
    $username = ucfirst($_SESSION['username']);
} else {
    header("Location: ../auth/login.php");
}

$getOrgUser = "SELECT * FROM org_members WHERE orgMember='$username' and confirmJoined='1'";
$getOrgUserRes = $conn->query($getOrgUser);

$getBugs = "SELECT * FROM bugs WHERE createdUser='$username'";
$getBugsRes = $conn->query($getBugs);

?>
<!DOCTYPE html>
<html>
    <head>
        <title id="title">Home</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="author" content="Camsdono Studios">
        <meta name="description" content="A better place to keep track of your bugs and manage teams">

        <link rel="apple-touch-icon" sizes="180x180" href="../../images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon/favicon-16x16.png">
        <link rel="manifest" href="../../images/favicon/site.webmanifest">

        <link rel="stylesheet" href="../../styles/styles.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body  class="blue">
        <div class="topnav" id="myTopnav">
            <a href="./home.php">Home</a>
            <a href="./organization.php">Organizations</a>
            <a href="#">Tickets</a>
            <a><i  class="dropbtn fa fa-lg fa-user-circle-o"></i></a>

            <div class="dropdown">
    <button class="dropbtn">Dropdown 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </div> 
           
            <a href="../displays/notificationdisplay.php"><i alt="notification-ico" class="fa fa-solid fa-bell"></i></a>

            <a href="javascript:void(0);" class="icon" onclick="OpenCloseNav()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="welcome-message">
            <h2 style="text-align: center;">Welcome <?=htmlspecialchars($username)?></h2>
        </div>
        <div class="info-row">
            <h4 style="margin-left: 5px;">Stats:</h4>
            <div class="info">
                <h5>Bugs Created:</h5>
                <p><?=mysqli_num_rows($getBugsRes)?></p>
            </div>
            <div class="info">
                <h5>Orgs In:</h5>
                <p><?=mysqli_num_rows($getOrgUserRes)?></p>
            </div>
        </div>
        
        <footer>
            <p class="footer-txt">@Camsdono Studios</p>
        </footer>
    </body>
</html>
<script src="../../js/openCloseNavBar.js"></script>