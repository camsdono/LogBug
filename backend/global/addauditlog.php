<?php
    function addAuditLog($message, $process, $userID, $userName, $ip, $bypass) {
        require('../config.php');
        session_start();
        if(!isset($_SESSION["username"]) && $bypass == false) {
            header("Location: ../../components/auth/login.php");
        } else {
            // get current date
            $date = date('Y-m-d H:i:s');
            $stmt = $conn->prepare("INSERT INTO audit_log (message, process, userID, userName, ip, dateCreated) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $message, $process, $userID, $userName, $ip, $date);
            $stmt->execute();
            $stmt->close();
        }
    }

    function auditBug($message, $process, $userID, $userName, $ip, $bypass) {
        require('../config.php');
        if(!isset($_SESSION["username"]) && $bypass == false) {
            header("Location: ../../components/auth/login.php");
        } else {
            // get current date
            $date = date('Y-m-d H:i:s');
            $stmt = $conn->prepare("INSERT INTO audit_log (message, process, userID, userName, ip, dateCreated) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $message, $process, $userID, $userName, $ip, $date);
            $stmt->execute();
            $stmt->close();
        }
    }
?>