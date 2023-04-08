<?php
require('../../backend/config.php');

session_start();

if(!$_SESSION['username'] == null) {
    $username = ucfirst($_SESSION['username']);
} else {
    header("Location: ../auth/login.php");
}



?>
<!DOCTYPE html>
<html>
    <head>
        
        <title id="title">Support</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="author" content="Camsdono Studios">
        <meta name="description" content="A better place to keep track of your bugs and manage teams">

        <link rel="apple-touch-icon" sizes="180x180" href="../../images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon/favicon-16x16.png">
        <link rel="manifest" href="../../images/favicon/site.webmanifest">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../../styles/Global/Support.css">
    </head>
    <body>
    <div class="container">
    <div class="chat-container">
        <div class="messages-container">
        </div>
      <div class="chat-form">
      <input type="text" id="message" placeholder="Type your message..." required>
        <div class="send-button" title="send" onclick="sendMessageToCarter('<?php echo $username; ?>')">
            <i class="fa fa-paper-plane"></i>
        </div>
      </div>
        
    </div>
    </div>

    </body>
</html>
<script src="../../js/displays/supportDisplay.js"></script>
<script>
    document.addEventListener('keydown', function(event) {
    if (event.key === "Enter") {
        var message = document.getElementById("message").value;
        if (message == "") {
            return;
        } else {
            sendMessageToCarter('<?php echo $username; ?>');
        }
    }
    });
</script>