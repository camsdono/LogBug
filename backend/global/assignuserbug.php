<?php

require('../config.php');

session_start();

$bugID = $_REQUEST['bugID'];
$userID = $_REQUEST['userID'];



$getUserID = "SELECT * FROM users WHERE email='$userID' OR username='$userID'";
$getUserIDRes = $conn->query($getUserID);

if (mysqli_num_rows($getUserIDRes) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($getUserIDRes)) {
        $newUserID = $row['id'];
        $username = $row['username'];
    }
} else {
    // user does not exist
    echo "User does not exist";
}

// check if user is in org 
$checkUser = "SELECT * FROM org_members WHERE memberID='$newUserID'";
$checkUserRes = $conn->query($checkUser);


if ($checkUserRes->num_rows > 0) {
    // check if user is in bug_members
    // check if bug exists 
    $checkBug = "SELECT * FROM bugs WHERE id='$bugID'";
    $checkBugRes = $conn->query($checkBug);

    if ($checkBugRes->num_rows > 0) {
        $checkBugMember = "SELECT * FROM bug_members WHERE userID='$newUserID' AND bugID='$bugID'";
        $checkBugMemberRes = $conn->query($checkBugMember);

        // put bug data into array
        $bugData = mysqli_fetch_assoc($checkBugRes);
    
        if ($checkBugMemberRes->num_rows > 0) {
            echo "User is already assigned to bug";
        } else {
            $assignMemberSQL = "INSERT INTO bug_members (userID, bugID, bugName, username) VALUES ('$newUserID', '$bugID', '$bugData[bugName]', '$username')";
            $assignMemberRes = $conn->query($assignMemberSQL);

            if ($assignMemberRes) {
                echo "<script>alert('User assigned to bug');</script>";
            } else {
                echo "<script>alert('Error assigning user to bug');</script>";
            }
        }

    } else {
        // bug does not exist
        echo "<script>alert('Bug does not exist');</script>";
    }

    
} else {
    // user is not in org_members
    echo "<script>alert('User is not in org');</script>";
}

?>