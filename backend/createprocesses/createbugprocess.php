<?php

require('../config.php');
require('../global/addauditlog.php');

if (isset($_POST["create-bug-btn"])) {
    session_start();

    $bugName = $_POST['bugName'];
    $bugDesc = $_POST['bugDesc'];
    $projectID = $_POST['projectID'];
    $projectName = $_POST['projectName'];
    $priority = $_POST['priority'];
    $createdUser = $_SESSION['username'];
    $dueDate = $_POST['dueDate'];
    
    $stmt = $conn->prepare("INSERT INTO bugs (bugName, bugDesc, projectID, projectName, priority, createdUser, dueDate) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $bugName, $bugDesc, $projectID, $projectName, $priority, $createdUser, $dueDate);

    $stmt->execute();

    $res = mysqli_stmt_get_result($stmt);

    if(!$res) {
        $message = "Bug $bugName has been created";
        $process = "bugCreated";
        $userID = $_SESSION['id'];
        $userName = $_SESSION['username'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $bypass = false;
        $bugID = $conn->insert_id;

        auditBug($message, $process, $userID, $userName, $ip, $bypass, $bugID);

        header("Location: ../../components/displays/projectdisplay.php?id=$projectID&page=1");
    } else {
        echo "An error has occured adding bug to project try again later.";
    }
    $stmt->close();
}

?>