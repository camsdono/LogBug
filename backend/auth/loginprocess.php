<?php

require('../config.php');

if (isset($_POST["login-btn"])) {
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $encryptedpass = md5($password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$encryptedpass'";
    $result = $conn->query($sql);
    if(mysqli_num_rows($result) > 0) {
        $_SESSION["username"] = $username;
        header("Location: ../../components/root/home.php");
    } else {
        echo "Incorrect Login Details";
    }
    
}

if (isset($_POST["register-btn"])) {
    $stmt = $conn->prepare("INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $username, $encryptedpass);

    // set parameters and execute
    $username = $_POST['username'];
    $email = $_POST['email'];

    $sql1 = "SELECT * FROM users WHERE username='$username' OR email='$email'"; 
    $result1 = $conn->query($sql1); 

    if(mysqli_num_rows($result1) > 0) {
        echo "Error Occured Account already in use.";
    } else {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $encryptedpass = md5($password);
        $stmt->execute();

        $stmt->close();

        header("Location: ../../components/auth/login.php");
    }
}

?>