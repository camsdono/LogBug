<?php
require('../../config.php');

$message = isset($_POST['message']) ? $_POST['message'] : null;
$from = isset($_POST['from']) ? $_POST['from'] : null;
$result = array();
date_default_timezone_set('GB');
$date = date('d-m-y h:i:s A');

if(!empty($message) && !empty($from)) {
    $stmt = $conn->prepare("INSERT INTO chat (message, sender, created) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $message, $from, $date);

    $stmt->execute();
    $stmt->close();
}

$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$items = $conn->query("SELECT * FROM `chat` WHERE `id` > " . $start);

while($row = $items->fetch_assoc()) {
    $result['items'][] = $row;
}

header('Access-Control-Allow-Origin: *');
header('Control-Type: application/json');

echo json_encode($result);

?>