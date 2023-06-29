<?php

  $URL = explode('/', $_SERVER['QUERY_STRING']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LogBug - Team Management Tool</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1; user-scalable=0">
  <meta name="author" content="Camsdono Studios">
  <meta name="description" content="A better place to keep track of your bugs and manage teams">

  <link rel="apple-touch-icon" sizes="180x180" href="../../images/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon/favicon-16x16.png">
  <link rel="manifest" href="../../images/favicon/site.webmanifest">
  <style>
    /* Add your custom CSS styles here */
    body {
      font-family: Arial, sans-serif;
      text-align: center;
    }
    
    h1 {
      margin-top: 100px;
      font-size: 36px;
    }
    
    p {
      margin-top: 20px;
      font-size: 18px;
    }
    
    .button {
      display: inline-block;
      padding: 10px 20px;
      font-size: 20px;
      text-decoration: none;
      background-color: #007bff;
      color: #fff;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }
    
    .button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <h1>Welcome to LogBug!</h1>
  <p>A powerful team management tool to streamline your workflow.</p>
  
  <div>
    <a class="button" href="./components/auth/signup.php">Sign Up</a>
    <a class="button" href="./components/auth/login.php">Login</a>
  </div>
</body>
</html>