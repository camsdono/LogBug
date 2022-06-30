<?php

require('config.php');

if (isset($_POST['login-btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $encryptedPass = md5($password);
    
    $sql = "SELECT * FROM users WHERE username='$username'&password='$encryptedPass'";
    
}
?>