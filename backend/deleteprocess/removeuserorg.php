<?php

require('../config.php');

if (isset($_POST["org-remove-user-btn"])) {
    session_start();

    $orgMember = $_POST['orgMember'];
    $orgID = $_POST['orgID'];

    // Remove user from org
    $sql = "DELETE FROM org_members WHERE orgID = ? AND orgMember = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "error has occured please try again later.";
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $orgID, $orgMember);
        $selectOrgMember = "SELECT * FROM org_members WHERE orgID = '$orgID' AND orgMember = '$orgMember'";
        $selectOrgMemberResult = mysqli_query($conn, $selectOrgMember);
        $selectOrgMemberRow = mysqli_fetch_array($selectOrgMemberResult);
        $orgMemberRole = $selectOrgMemberRow['orgRole'];

        if($orgMemberRole == "owner") {
            header("Location: ../../components/assign/adduserorg.php?id=$orgID");
            echo "Cant remove owner from org!";
        } else {
            mysqli_stmt_execute($stmt);
            header("Location: ../../components/assign/adduserorg.php?id=$orgID");
        }  
    }
}

?>