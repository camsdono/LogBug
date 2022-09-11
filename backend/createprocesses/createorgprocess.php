<?php

require('../config.php');

if (isset($_POST["create-org-btn"])) {
    session_start();

    $orgOwner = $_SESSION['username'];
    $joinCode = substr(md5(uniqid(mt_rand(), true)) , 0, 8);

    $stmt = $conn->prepare("INSERT INTO orgs (orgName, orgDesc, joinCode, orgOwner) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $orgName, $orgDesc, $joinCode, $orgOwner);

    

    // set parameters and execute
    $orgName = $_POST['orgName'];
    $orgDesc = $_POST['orgDesc'];

    $stmt->execute();
    
    $orgID = mysqli_insert_id($conn);
    $memberID = $_SESSION["id"];
    $orgRole = "owner";

    $getUserData = "SELECT * FROM users WHERE id=$memberID";
    $getUserDataResult = mysqli_query($conn, $getUserData);
    $getUserRow = mysqli_fetch_array($getUserDataResult);

    $email = $getUserRow['email'];

    $addmemberorg = $conn->prepare("INSERT INTO org_members (orgName, orgID, orgMember, memberID, orgRole, assignCode, confirmJoined) VALUES (?, ?, ?, ?, ?, ?, 1)");
    $addmemberorg->bind_param("sisiss", $orgName, $orgID, $orgOwner, $memberID, $orgRole, $joinCode);

    $addmemberorg->execute();
    

    $res = mysqli_stmt_get_result($stmt);
    $res1 = mysqli_stmt_get_result($addmemberorg);

    if(!$res && !$res1) {
       //get data from form
        $message = "You have been invited to join an organization on BugTracker. Please click the link below to join the organization. http://localhost/bugtracker/components/assign/joinorg.php?joinCode=$joinCode";
        $to = "camsdonostudios@gmail.com";
        $subject = "BugTracker Organization Invite";
        $txt ="Email = " . $email . "\r\n Message =" . $message;
        $headers = "From: logbugnoreply@gmail.com" . "\r\n" .
            "CC: logbugnoreply@gmail.com";
        if($email!=NULL){
            mail($to,$subject,$txt,$headers);
        }
        header("Location: ../../components/root/organization.php");
    } else {
        echo "An error has occured creating org try again later.";
    }

    $stmt->close();
    $addmemberorg->close();
    
}

?>