<?php

require_once('../config.php');
session_start();
if (!isset($_SESSION['username'])){
    header('Location: ../login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title>Edit Bugs</title>
</head>
<body>
  
</body>