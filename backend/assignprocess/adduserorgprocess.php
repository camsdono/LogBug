<?php

require('../config.php');


if (isset($_POST["org-assign-user-btn"])) {
    session_start();

    $username = $_POST['username'];
    $userRole = $_POST['userRole'];
    $orgid = $_POST['orgid'];
    $orgname = $_POST['orgname'];
    $assignCode = substr(md5(uniqid(mt_rand(), true)) , 0, 8);

    $getUser = "SELECT * FROM users WHERE username = '$username'";
    $getUserResult = mysqli_query($conn, $getUser);

    if(mysqli_num_rows($getUserResult) > 0) {
        $getUserRow = mysqli_fetch_array($getUserResult);

        $getUserID = $getUserRow['id'];
    
        $stmt = $conn->prepare("INSERT INTO org_members (orgName, orgID, orgMember, memberID, orgRole, assignCode) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisiss", $orgname, $orgid, $username, $getUserID, $userRole, $assignCode);
    
        $stmt->execute();
        $res = mysqli_stmt_get_result($stmt);
    
        if(!$res) {
            header("Location: ../../components/assign/adduserorg.php?id=$orgid");
        } else {
            echo "An error has occured adding bug to project try again later.";
        }
        
        $stmt->close();
    }
}

?>