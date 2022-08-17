<?php

require('../config.php');

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
        header("Location: ../../components/displays/projectdisplay.php?id=$projectID");
    } else {
        echo "An error has occured adding bug to project try again later.";
    }
    $stmt->close();
}

?>