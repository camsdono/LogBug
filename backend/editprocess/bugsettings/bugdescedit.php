<?php 

require('../../config.php');

$bugdesc = $_POST['bugDesc'];
$bugID = $_POST['bugID'];

// check bug with id exists or not
$check = mysqli_query($conn, "SELECT * FROM bugs WHERE id = '$bugID'");

// get projectID
$projectID = mysqli_fetch_assoc($check)['projectID'];

if(mysqli_num_rows($check) == 0){
    echo "Bug with that ID does not exist";
    exit();
} else {
    $sql = "UPDATE bugs SET bugDesc = '$bugdesc' WHERE id = '$bugID'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Bug description updated successfully";
        header("Location: ../../../components/root/project.php?projectID=$projectID");
    } else {
        echo "Error updating bug description";
        header("Location: ../../../components/root/project.php?projectID=$projectID");
    }
}

?>