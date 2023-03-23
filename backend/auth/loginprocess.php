<?php

require('../config.php');
require('../global/addauditlog.php');
require('../global/checkrequests.php');
require('../global/pfpmanager.php');

if (isset($_POST["login-btn"])) {
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $encryptedpass = md5($password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$encryptedpass'";
    $result = $conn->query($sql);

    if(mysqli_num_rows($result) > 0) {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip=$_SERVER['HTTP_CLIENT_IP'];
          }
        elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else{
            $ip=$_SERVER['REMOTE_ADDR'];
        }

        $sql2 = "SELECT * FROM blacklists WHERE ip='$ip'";
        $result2 = $conn->query($sql2);

        if(mysqli_num_rows($result2) > 0) {
            echo "IP is blacklisted";
            exit();
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION["id"] = $row['id'];
            
            $pfp = CheckPFP($row['pfp'], $username);
            $_SESSION["pfp"] = $pfp;
        }
        
        $_SESSION["username"] = $username;

        $message = "User logged in";
        $process = "Login";
        $userID = $_SESSION["id"];
        $userName = $_SESSION["username"];

        addAuditLog($message, $process, $userID, $userName, $ip, False);
        
        header("Location: ../../components/root/home.php");
    } else {
        echo "Incorrect Login Details";
    }
}

if (isset($_POST["register-btn"])) {
    session_start();
    $stmt = $conn->prepare("INSERT INTO users (name, email, username, password, pfp) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $username, $encryptedpass, $pfp);

    $username = $_POST['username'];
    $email = $_POST['email'];

    // Get the first character of the username
    $firstChar = substr($username, 0, 1);

    // Create the PFP
    $pfp = CreatePFP($firstChar);

    $sql1 = "SELECT * FROM users WHERE username='$username' OR email='$email'"; 
    $result1 = $conn->query($sql1); 

    if(mysqli_num_rows($result1) > 0) {
        echo "Error Occured Account already in use.";
    } else {
        $end_time = microtime(true);

        $name = $_POST['name'];
        $password = $_POST['password'];
        $confirmPass = $_POST['confirm-password'];
        $getToken = $_POST['token'];
        $start_time = $_POST['start-time'];

        if ($password != $confirmPass) {
            echo "Passwords do not match";
            exit();
        }

        if($getToken != null) {
            echo "Nice Try ;)";
            exit();
        }

        $time_diff = $end_time - $start_time;
        $hours = (int)($time_diff/60/60);
        $minutes = (int)($time_diff/60)-$hours*60;
        $seconds = (int)$time_diff-$hours*60*60-$minutes*60;
        $min_time = 3;

        if($seconds < $min_time) {
            echo "Please wait 3 seconds before submitting the form again. Thank you.";
            exit();
        } else {
            $encryptedpass = md5($password);
            
            if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                $ip=$_SERVER['HTTP_CLIENT_IP'];
            }
            elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else{
                $ip=$_SERVER['REMOTE_ADDR'];
            }

            $sql2 = "SELECT * FROM blacklists WHERE ip='$ip'";
            $result2 = $conn->query($sql2);
            
            if(mysqli_num_rows($result2) > 0) {
                echo "IP is blacklisted";
                exit();
            }

            if (CheckRequests($ip)) {
                exit();
                header("Location: ../../components/auth/signup.php?a=RequestMany");
            } else {
                $stmt->execute();

                $message = "User registered";
                $process = "Register";
                $userID = $stmt->insert_id;;
                $userName = $username;
        
                addAuditLog($message, $process, $userID, $userName, $ip, True);
        
                $stmt->close();

                

        
                header("Location: ../../components/auth/signup.php?");
            }
        }
    }
}

?>