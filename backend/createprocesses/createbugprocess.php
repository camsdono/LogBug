<?php

require('../config.php');

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
        header("Location: ../../components/root/project.php?projectID=$projectID");
    } else {
        echo "An error has occured adding bug to project try again later.";
    }
    $stmt->close();
}

?>