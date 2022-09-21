<?php

require('../../config.php');

if (isset($_POST["org-edit-name-btn"])) {
    session_start();

    $orgid = $_POST['orgid'];
    $newOrgName = $_POST['orgname'];

    $stmt = $conn->prepare("UPDATE orgs SET orgName=? WHERE id=?");
    $stmt->bind_param("si", $newOrgName, $orgid);

    $stmt1 = $conn->prepare("UPDATE org_members SET orgName=? WHERE orgID=?");
    $stmt1->bind_param("si", $newOrgName, $orgid);

    $stmt->execute();
    $stmt1->execute();

    $res = mysqli_stmt_get_result($stmt);
    $res1 = mysqli_stmt_get_result($stmt1);

    if(!$res && !$res1) {
        header("Location: ../../../components/edit/orgsettings.php?id=$orgid");
    } else {
        echo "An error has occured updating org settings try again later.";
    }

    $stmt->close();
    $stmt1->close();
}



?>