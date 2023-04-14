<?php 

require('../config.php');

$bugID = $_REQUEST['bugID'];

$getBugInfo = "SELECT * FROM bugs WHERE id='$bugID'";
$result = $conn->query($getBugInfo);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        'bugID' => $row['id'],
        'bugName' => $row['bugName'],
        'bugDesc' => $row['bugDesc'],
        'projectID' => $row['projectID'],
        'projectName' => $row['projectName'],
        'priority' => $row['priority'],
        'createdUser' => $row['createdUser'],
        'closedBug' => $row['closedBug'],
        'dueDate' => $row['dueDate']
    );
    echo json_encode($data);
} else {
    echo json_encode(array('error' => 'No results found'));
}

?>