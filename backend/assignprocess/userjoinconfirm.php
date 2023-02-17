<?php

require('../config.php');

if (isset($_POST["confirm-btn"])) {
    $user = $_SESSION['username'];
    $orgId = $_POST['orgId'];
    $sql = "UPDATE org_members SET confirmJoined = '1' WHERE orgMember = '$user' AND orgID='1'";
}

if (isset($_POST["deny-btn"])) {

}

?>