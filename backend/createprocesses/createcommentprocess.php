<?php

require('../config.php');

if (isset($_POST["comment-send"])) {
    session_start();

    $bugID = $_POST["bugID"];
    $author = $_POST["commentAuthor"];
    $message = $_POST["comment-msg"];
    
    $date = date("Y-m-d H:i:s");
    
    $stmt = $conn->prepare("INSERT INTO bug_comments (bugID, commentAuthor, message, dateSent) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $bugID, $author, $message, $date);

    $stmt->execute();

    if(!$res) {
        header("Location: ../../components/displays/bugdisplay.php?bugID=$bugID");
    } else {
        echo "An error has occured adding comment to bug try again later.";
    }
    $stmt->close();
}

?>