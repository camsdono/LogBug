<?php 

require('../config.php');

$userID = $_REQUEST['userID'];
$bugID = $_REQUEST['bugID'];

// Check if user is in the organization
$sql = "SELECT * FROM bug_members WHERE userID = '$userID' AND bugID = '$bugID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $sql = "DELETE FROM bug_members WHERE bugID = '$bugID'";
    $result = mysqli_query($conn, $sql);

    $sql1 = "DELETE FROM bugs WHERE id = '$bugID'";
    $result1 = mysqli_query($conn, $sql1);

    echo "success";
} else {
    echo "error";
}

?>