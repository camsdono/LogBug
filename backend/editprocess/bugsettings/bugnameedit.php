<?php 

require('../../config.php');

$bugname = $_POST['bugName'];
$bugID = $_POST['bugID'];

// check bug with id exists or not
$check = mysqli_query($conn, "SELECT * FROM bugs WHERE id = '$bugID'");

// get projectID
$projectID = mysqli_fetch_assoc($check)['projectID'];

if(mysqli_num_rows($check) == 0){
    echo "Bug with that ID does not exist";
    exit();
} else {
    $sql = "UPDATE bugs SET bugName = '$bugname' WHERE id = '$bugID'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Bug name updated successfully";
        header("Location: ../../../components/root/project.php?projectID=$projectID");
    } else {
        echo "Error updating bug name";
        header("Location: ../../../components/root/project.php?projectID=$projectID");
    }
}

?>