<?php

require('../config.php');

$bugID = $_REQUEST['bugID'];
$status = $_REQUEST['status'];

// get current bug status from id
$sql = "SELECT * FROM bugs WHERE id = '$bugID'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$currentStatus = $row['closedBug'];

// if current status is 0 (open) then change to 1 (closed) and the variable is called closedBug
if ($currentStatus == 0) {
    $closedBug = 1;
} else {
    $closedBug = 0;
}

// update the bug status
$sql = "UPDATE bugs SET closedBug = '$closedBug' WHERE id = '$bugID'";
$result = mysqli_query($conn, $sql);

// if the update was successful then return the new status
if ($result) {
    echo $closedBug;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>