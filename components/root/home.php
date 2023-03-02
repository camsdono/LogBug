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

        <!---<link rel="stylesheet" href="../../styles/styles.css" /> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <style>
        body {
            margin: 0;
            font-family: 'Prompt', sans-serif;
            color: white;
            /*background: #202731; */
            overflow-x: hidden;
        }

        .profile-nav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            height: 60px;
            padding: 0 20px;
            background-color: #f5f5f5;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            background-color: transparent;
            border: none;
            outline: none;
            cursor: pointer;
        }

        .profile-image {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .profile-name {
            font-size: 16px;
            font-weight: bold;
        }

        .dropdown-menu {
            width: 150px;
            background-color: #f5f5f5;
            display: none;
            flex-direction: column;
            position: absolute;
            right: 0;
            text-align: center;
            z-index: 1;
        }

        .dropdown-menu .dropdown-item:first-child {
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .dropdown-menu .dropdown-item:last-child {
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .dropdown-item {
            font-size: 16px;
            padding: 12px 30px;
            color: #000;
            text-decoration: none;
        }

        .dropdown-item:hover {
            background-color: #ddd;
        }

        .icon {
            display: none;
        }

        /* Mobile */
        @media screen and (max-width: 600px) {
            .icon {
                display: block;
                position: absolute;
                top: 0;
                left: 0;
                transform: translate(25%, 50%);
                font-size: 1.8rem;
                cursor: pointer;
            }

            .icon {
                color: black;
            }

            .profile-nav {
                display: none;
            }
        }
    </style>

    <body>
    <nav class="profile-nav">
        <div class="dropdown">
            <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="profile-image" src="https://via.placeholder.com/50x50" alt="Profile Image">
                <span class="profile-name"><?=htmlspecialchars($username)?></span>
            </button>
            <div class="dropdown-menu" id="menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="../../backend/auth/logout.php">Logout</a>
            </div>
        </div>
    </nav>
            <a href="javascript:void(0);" class="icon" onclick="OpenCloseNav()">
                <i class="fa fa-bars"></i>
            </a>
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
<script>
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

</script>