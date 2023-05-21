<?php

require('../config.php');

$orgID = $_REQUEST['orgID'];
$projectID = $_REQUEST['projectID'];

$sql = "DELETE FROM projects WHERE id = '$projectID'";
$result = mysqli_query($conn, $sql);

echo "success";
header("Location: ../../components/displays/orgdisplay.php?id=$orgID");


?>