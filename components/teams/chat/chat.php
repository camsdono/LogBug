<?php

require('../../../backend/config.php');

session_start();

if(!$_SESSION['username'] == null) {
    $username = ucfirst($_SESSION['username']);
} else {
    header("Location: ../auth/login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        var from = "<?php echo $username ?>";
        var start = 0;
        var url = "http://localhost/LogBug-master/backend/teams/chatprocess/messageprocess.php";
        $(document).ready(function() {
            load();

            $('form').submit(function(e) {
                $.post(url, {
                    message: $('#message').val(),
                    from: from
                });
                $('#message').val('');
                return false;                                                       
            })
        });

        function load() {
            $.get(url + '?start=' + start, function(result) {
                if(result.items) {
                    result.items.forEach(item => {
                        start = item.id;
                        $('#messages').append(renderMessage(item));
                    })
                };
                load();
            });
        }

        function renderMessage(item) {
            console.log(item);
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="../../../styles/chatStyles.css">
</head>
<body>
   <div id="messages"></div>
   <form>
        <input type="text" id="message" autocomplete="off" autofocus placeholder="Type message...">
        <input type="submit" value="Send">
   </form>
</body>