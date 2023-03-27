<?php

require('../config.php');

$userID = $_REQUEST['userID'];
$orgID = $_REQUEST['orgID'];

$getOrgInfo = "SELECT * FROM org_members WHERE memberID='$userID' AND orgID='$orgID'";
$result = $conn->query($getOrgInfo);

// get user info
$getInfo = "SELECT * FROM users WHERE id='$userID'";
$result1 = $conn->query($getInfo);

/* encode results to json */
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $row1 = $result1->fetch_assoc();
    $data = array(
        'memberID' => $row['memberID'],
        'orgID' => $row['orgID'],
        'role' => $row['orgRole'],
        'userID' => $row1['id'],
        'name' => $row1['name'],
        'email' => $row1['email'],
        'pfp' => $row1['pfp']
    );
    echo json_encode($data);
} else {
    echo json_encode(array('error' => 'No results found'));
}

?>