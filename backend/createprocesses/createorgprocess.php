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

    $addmemberorg = $conn->prepare("INSERT INTO org_members (orgName, orgID, orgMember, memberID) VALUES (?, ?, ?, ?)");
    $addmemberorg->bind_param("sisi", $orgName, $orgID, $orgOwner, $memberID);

    $addmemberorg->execute();
    

    $res = mysqli_stmt_get_result($stmt);
    $res1 = mysqli_stmt_get_result($addmemberorg);

    if(!$res && !$res1) {
        header("Location: ../../components/root/organization.php");
    } else {
        echo "An error has occured creating org try again later.";
    }

    $stmt->close();
    
}

?>