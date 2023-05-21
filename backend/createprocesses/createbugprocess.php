<?php

require('../config.php');
require('../global/addauditlog.php');

if (isset($_POST["add-bug-btn"])) {
    session_start();

    $bugName = $_POST['bugName'];
    $bugDesc = $_POST['bugDesc'];
    $projectID = $_POST['projectID'];
    $projectName = $_POST['projectName'];
    $priority = $_POST['bugPriority'];
    $createdUser = $_SESSION['username'];
    
    $stmt = $conn->prepare("INSERT INTO bugs (bugName, bugDesc, projectID, projectName, priority, createdUser) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $bugName, $bugDesc, $projectID, $projectName, $priority, $createdUser);

    $stmt->execute();

    $res = mysqli_stmt_get_result($stmt);

    if(!$res) {
        $message = "Bug" . $bugName . " has been created for project " . $projectName . " by " . $createdUser . ".";
        $process = "bugCreated";
        $userID = $_SESSION['id'];
        $userName = $_SESSION['username'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $bypass = false;
        $bugID = $conn->insert_id;

        auditBug($message, $process, $userID, $userName, $ip, $bypass);

        header("Location: ../../components/root/project.php?projectID=$projectID");
    } else {
        echo "An error has occured adding bug to project try again later.";
        header("Location: ../../components/root/project.php?projectID=$projectID");
    }
    $stmt->close();
}

?>