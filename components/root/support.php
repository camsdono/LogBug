<?php
require('../../backend/config.php');

session_start();

if(!$_SESSION['username'] == null) {
    $username = ucfirst($_SESSION['username']);
} else {
    header("Location: ../auth/login.php");
}

function SendMessageToCarter($message) {
    $data = array(
        "text" => $message,
        "key" => "e15b1dad-becf-42a1-b1df-bb4e852b1f36",
        "playerId" => $_SESSION['username']
    );
    
    $options = array(
        "http" => array(
            "header" => "Content-Type: application/json",
            "method" => "POST",
            "content" => json_encode($data)
        )
    );
    
    $context = stream_context_create($options);
    $response = file_get_contents("https://api.carterlabs.ai/chat", false, $context);
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
    <div class="chat-container">
        <div class="messages-container">
            <div class="message incoming">
                <p>Hello, this is LogBug's Personal Support AI: Powered By Carter</p>
            </div>
            <div class="message outgoing">
                <p>Hi there! I have a question about my account.</p>
            </div>
            <div class="message incoming">
                <p>What's your question?</p>
            </div>
        </div>
        <form class="chat-form">
            <input type="text" placeholder="Type your message...">
            <button type="submit">Send</button>
        </form>
    </div>

    </body>
</html>

