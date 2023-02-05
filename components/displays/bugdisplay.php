<?php

require('../../backend/config.php');

session_start();

$bugID = $_GET['bugID'];

$getBug = "SELECT * FROM bugs WHERE id=$bugID";
$getBugRes = $conn->query($getBug);

if(!$_SESSION['username'] == null) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../auth/login.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title id="title">BugDisplay</title>

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
    <body  class="blue">
       
        <div class="topnav" id="myTopnav">
            <a href="../root/home.php">Home</a>
            <a href="../root/organization.php">Organizations</a>
            <a href="#">Tickets</a>

            <a href="javascript:void(0);" class="icon" onclick="OpenCloseNav()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        
        <?php
        
        if(mysqli_num_rows($getBugRes) > 0) {
            while ($row = mysqli_fetch_array($getBugRes)) {
            ?>
        
            <ul class="breadcrumbs">
                <li class="breadcrumbs-item">
                    <a href="./projectdisplay.php?id=<?=$row['projectID']?>&page=1" class="breadcrumbs-link"><?=$row['projectName']?></a> 
                </li> 
                <li class="breadcrumbs-item"> 
                    <a href="#" class="breadcrumbs-link"><?=$row['bugName']?></a> 
                </li> 
            </ul> 
         
            <div class="org-description"> 
                <p>Description: <?=$row['bugDesc']?></p> 
            </div> 
 
            <div class="bug-options-bar"> 
                <div class="bug-options"> 
                    <div class="bug-option" onclick="ChangeOption(1)"> 
                        Users 
                    </div> 
                    <div class="bug-option" onclick="ChangeOption(2)"> 
                        Comments 
                    </div> 
                </div> 
            </div> 
             
            <div class="users-holder" id="users"> 
            <div class="assign-holder"> 
                <a class="due-date assign-user-btn" href="../assign/assignuserbug.php?id=<?=$row['id']?>">Assign User</a> 
            </div> 
            <h3 class="members" style="margin-bottom: 0px;">Assigned Members:</h3> 
            <div class="members"> 
                <?php 
                    $getMembers = "SELECT * FROM bug_members WHERE bugID=$bugID"; 
                    $getMembersRes = $conn->query($getMembers); 
                     
                    if(mysqli_num_rows($getMembersRes) > 0) { 
                        while ($row = mysqli_fetch_array($getMembersRes)) { 
                ?> 
                            <p><?=$row['username']?></p> 
                <?php 
                        } 
                    } 
                ?> 
            </div> 
            </div> 
            <div class="comment-holder" id="comments" > 
                <div class="comments-holder"> 
                    <a class="comemnt-bug comment-btn" href="../assign/assignuserbug.php?id=<?=$row['id']?>">Add Comment</a> 
                </div> 
                <div class="comments"> 
                <h3>Comments:</h3> 
                <?php 
                    $getComments = "SELECT * FROM bug_comments WHERE bugID=$bugID"; 
                    $getCommentsRes = $conn->query($getComments); 
                     
                    if(mysqli_num_rows($getCommentsRes) > 0) { 
                        while ($row = mysqli_fetch_array($getCommentsRes)) { 
                        ?> 
                            <div class="comment"> 
                                <p><?=$row['message']?></p> 
                                <p class="comment-author">- <?=$row['commentAuthor']?></p> 
                            </div> 
                        <?php 
                        } 
                    } 
                    ?> 
                </div> 
            
            </div> 
            <?php 
        } 
        } 
        ?> 
        </div> 
         
        <footer> 
            <p class="footer-txt">@Camsdono Studios</p> 
        </footer> 
    </body> 
</html> 
<script src="../../js/openCloseNavBar.js"></script> 
<script> 
    var user = document.getElementById("users"); 
    var comments = document.getElementById("comments"); 
    comments.style.display = "none"; 

    function ChangeOption(id) { 
        if(id == 1) { 
            user.style.display = "block"; 
            comments.style.display = "none"; 
        } 
        if(id == 2) { 
            user.style.display = "none"; 
            comments.style.display = "block"; 
        } 
    } 
</script> 