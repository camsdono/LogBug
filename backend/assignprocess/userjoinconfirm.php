<?php

require('../config.php');

if (isset($_POST["confirm-btn"])) {
    session_start();
    $user = $_SESSION['username'];
    $orgId = $_POST['orgId'];
    $sql = "UPDATE org_members SET confirmJoined = '1' WHERE orgMember = '$user' AND orgID='$orgId'";
    $result = $conn->query($sql);

    if ($result) {
        header("Location: ../../components/root/organization.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST["deny-btn"])) {
    session_start();
    $user = $_SESSION['username'];
    $orgId = $_POST['orgId'];
    $sql = "DELETE FROM org_members WHERE orgMember = '$user' AND orgID='$orgId'";
    $result = $conn->query($sql);

    if ($result) {
        header("Location: ../../components/root/organization.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>