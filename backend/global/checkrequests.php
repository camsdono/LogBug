<?php

function CheckRequests($ipAddress) {
    require('../config.php');
    $maxRequests = 10;
    $timePeriod = 10;
    // check reqyests frin audit_log 
    $currentTime = time();
    $startTime = $currentTime - $timePeriod;
    $sql = "SELECT COUNT(*) as requestCount FROM audit_log WHERE ip = '$ipAddress' AND dateCreated >= $startTime AND dateCreated <= $currentTime";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $requestCount = $row['requestCount'];

    if ($requestCount >= $maxRequests) {
        ?>
        <script>
            alert("Take a chill pill. Too many requests. Please try again later.");
        </script>
        <?php
        return True;
    } else {
        return False;
    }
}

?>