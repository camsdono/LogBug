<?php

require('../../backend/config.php');

session_start();

if(!$_SESSION['username'] == null) {
    $username = ucfirst($_SESSION['username']);
} else {
    header("Location: ../auth/login.php");
}

$getOrgUser = "SELECT * FROM org_members WHERE orgMember='$username' and confirmJoined='1' AND orgRole='owner'";
$getOrgUserRes = $conn->query($getOrgUser);

$getBugs = "SELECT * FROM bugs WHERE createdUser='$username' AND closedBug='0'";
$getBugsRes = $conn->query($getBugs);

$getAuditLog = "SELECT * FROM audit_log WHERE username='$username' AND process='bugCreated'  LIMIT 5";
$getAuditLogRes = $conn->query($getAuditLog);

//Get user details
$getDetails = "SELECT * FROM users WHERE username='$username'";
$getDetailsRes = $conn->query($getDetails);

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

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script>
            //get color theme from localstorage if exitsts
            if (localStorage.getItem('theme') == 'dark') {
                document.write('<link rel="stylesheet" href="../../styles/Global/DarkHome.css">');
                <?php $color = "dark"; ?>
            } else {
                document.write('<link rel="stylesheet" href="../../styles/Global/LightHome.css">');
                <?php $color = "light"; ?>
            }
        </script>
    </head>

    <body>
        <nav class="profile-nav">
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

        <div class="dashboard">
            <div class="titles">
                <div class="overview-title">
                    <h1 style="display: inline-block; margin-right: 50%;">Analytics Overview</h1>
                </div>
                <div class="overview-title">
                    <h1 style="display: inline-block; margin-right: 12%;">Recent Activity</h1>
                </div>
            </div>

            <div class="card-row">
                <div class="card">
                    <div class="image"></div>
                    <div class="card-figure">
                        <h2><?=mysqli_num_rows($getBugsRes)?></h2>
                    </div>
                    <div class="subject">
                        <h5>Open Bugs</h5>
                    </div>
                </div>
                <div class="card">
                    <div class="image"></div>
                    <div class="card-figure">
                        <h2><?=mysqli_num_rows($getOrgUserRes)?></h2>
                    </div>
                    <div class="subject">
                        <h5>Organization Owner Count</h5>
                    </div>
                </div>
                <div class="recent-bugs">
                    <div class="recent-bug">
                        <ul class="recent-act">
                            <?php
                            if (mysqli_num_rows($getAuditLogRes) == 0) {
                                echo "<li class='recent-bug'>No recent activity</li>";
                            }
                            while ($row = mysqli_fetch_array($getAuditLogRes)) {
                            ?>
                            <li class="recent-bug"><a href="../displays/bugdisplay.php?bugID=<?=$row['objectID']?>"><?=htmlspecialchars($row['message'])?></a></li>
                            <?php
                            }
                            ?>                                                                                                                                                    
                        </ul>
                    </div>
            </div>
            </div>
        </div>
    </body>
</html>
<script src="../../js/openCloseNavBar.js"></script>
<script>
    var color = document.getElementById('color');

    if (localStorage.getItem('theme') == 'dark') {
        color.innerHTML = 'Light Mode';
    } else {
        color.innerHTML = 'Dark Mode';
    }
    document.querySelector('.dropdown-toggle').addEventListener('mouseover', function() {
        document.querySelector('.dropdown-menu').style.display = 'flex';
    });
    document.querySelector('.dropdown-menu').addEventListener('mouseover', function() {
        document.querySelector('.dropdown-menu').style.display = 'flex';
    });

    document.querySelector('.dropdown-toggle').addEventListener('mouseleave', function() {
        document.querySelector('.dropdown-menu').style.display = 'none';
    });

    document.querySelector('.dropdown-menu').addEventListener('mouseleave', function() {
        document.querySelector('.dropdown-menu').style.display = 'none';
    });

    document.querySelector('.color-select').addEventListener('click', function() {
        if (localStorage.getItem('theme') == 'dark') {
            localStorage.setItem('theme', 'light');
            location.reload();
        } else {
            localStorage.setItem('theme', 'dark');
            location.reload();
        }
    });
</script>