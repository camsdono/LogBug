<?php

require('../config.php');

if (isset($_POST["create-org-btn"])) {
    session_start();

    date_default_timezone_set("Europe/London");
    $date = date("Y-m-d H:i:s");

    $orgOwner = $_SESSION['username'];
    $joinCode = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
    //check if user has created a org within a hour 
    $checkOrg = "SELECT * FROM orgs WHERE orgOwner='$orgOwner' AND createdDate > DATE_SUB(NOW(), INTERVAL 30 MINUTE)";
    $checkOrgRes = mysqli_query($conn, $checkOrg);

    if(mysqli_num_rows($checkOrgRes) > 0) {
        echo "You have already created an organization within the half hour.";
        exit();
    }
    $stmt = $conn->prepare("INSERT INTO orgs (orgName, orgDesc, joinCode, orgOwner, createdDate) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $orgName, $orgDesc, $joinCode, $orgOwner, $date);

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
        header("Location: ../../components/root/organization.php");
    } else {
        echo "An error has occured creating org try again later.";
    }

    $stmt->close();
    $addmemberorg->close();
    
}

?>