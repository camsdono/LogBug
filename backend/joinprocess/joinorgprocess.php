<?php

require('../config.php');
require('../global/addauditlog.php');
require('../global/ipmanager.php');

if (isset($_POST["join-org-btn"])) {
    session_start();

    $joinCode = $_POST['joinCode'];
    $userID = $_SESSION['id'];
    $userName = $_SESSION['username'];
    $ip = GetIP();

    $stmt = $conn->prepare("SELECT * FROM orgs WHERE joinCode = ?");
    $stmt->bind_param("s", $joinCode);
    $stmt->execute();
    $res = mysqli_stmt_get_result($stmt);

    //get the orgID

    if(mysqli_num_rows($res) > 0) {
        // Check if user is already in the organization
        $row = mysqli_fetch_assoc($res);
        $orgID = $row['id'];
        $orgName = $row['orgName'];
        $orgRole = "member";

        $stmt1 = $conn->prepare("SELECT * FROM org_members WHERE orgID = ? AND memberID = ?");")";
        $stmt1->bind_param("ss", $orgID, $userID);
        $stmt1->execute();
        $res1 = mysqli_stmt_get_result($stmt1);
        
        if(mysqli_num_rows($res1) == 0) {

            // Add user to the organization
            $stmt2 = $conn->prepare("INSERT INTO org_members (orgID, memberID, orgMember, orgName, assignCode, orgRole, confirmJoined) VALUES (?, ?, ?, ?, ?, ?, 1)");
            $stmt2->bind_param("ssssss", $orgID, $userID, $userName, $orgName, $joinCode, $orgRole);
            $stmt2->execute();
            $res2 = mysqli_stmt_get_result($stmt2);

            if(!$res2) {
                $message = "Joined Organization";
                $process = "joinOrg";
                $bypass = false;

                addAuditLog($message, $process, $userID, $userName, $ip, $bypass);

                header("Location: ../../components/root/organization.php");
            } else {
                echo "An error occured while joining the organization";
            }
            $stmt2->close();
        } else {
            echo "You are already in this organization";
        }
    } else {
        echo "Organization does not exist";
    }
}

?>