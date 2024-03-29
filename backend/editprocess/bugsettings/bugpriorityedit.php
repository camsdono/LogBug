<?php 

require('../../config.php');

$priority = $_POST['bugPriority'];
$bugID = $_POST['bugID'];

// check if bug with that id exists
$check = mysqli_query($conn, "SELECT * FROM bugs WHERE id = '$bugID'");

// get projectID
$projectID = mysqli_fetch_assoc($check)['projectID'];

if(mysqli_num_rows($check) == 0){
    echo "Bug with that ID does not exist";
    exit();
} else {
    $sql = "UPDATE bugs SET priority = '$priority' WHERE id = '$bugID'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Bug priority updated successfully";
        header("Location: ../../../components/root/project.php?projectID=$projectID");
    } else {
        echo "Error updating bug priority";
        header("Location: ../../../components/root/project.php?projectID=$projectID");
    }
}

?>