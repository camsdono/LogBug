<?php 

require('../config.php');

$userID = $_REQUEST['userID'];
$orgID = $_REQUEST['orgID'];

// Check if user is in the organization
$sql = "SELECT * FROM org_members WHERE memberID = '$userID' AND orgID = '$orgID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $sql = "DELETE FROM org_members WHERE orgID = '$orgID'";
    $result = mysqli_query($conn, $sql);

    $sql1 = "DELETE FROM orgs WHERE id = '$orgID'";
    $result1 = mysqli_query($conn, $sql1);

    echo "success";
} else {
    echo "error";
}

?>