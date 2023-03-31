<?php 

require('../config.php');

$userID = $_REQUEST['userID'];
$orgID = $_REQUEST['orgID'];
$newRole = $_REQUEST['role'];

//check if user is in org
$checkUser = "SELECT * FROM org_members WHERE memberID='$userID' AND orgID='$orgID'";
$result = $conn->query($checkUser);

// if user is in org, change role
if ($result->num_rows > 0) {
    $changeRole = "UPDATE org_members SET orgRole='$newRole' WHERE memberID='$userID' AND orgID='$orgID'";
    $result1 = $conn->query($changeRole);

    $stmt = $conn->prepare("UPDATE org_members SET orgRole=? WHERE memberID=? AND orgID=?");
    $stmt->bind_param("sii", $newRole, $userID, $orgID);

    $stmt->execute();

    $res = mysqli_stmt_get_result($stmt);
    if (!$res) {
        echo json_encode(array('success' => 'Role changed'));
    } else {
        echo json_encode(array('error' => 'Error changing role'));
    }
} else {
    echo json_encode(array('error' => 'User not in org'));
}

?>