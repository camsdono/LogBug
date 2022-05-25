<?php
require_once('../config.php');
session_start();
if (!isset($_SESSION['username'])){
    header('Location: ../login.php');
}

else {
    $username = $_GET['user'];
    $code = $_GET['code'];

    $sql1 = "SELECT * FROM org_members WHERE username='$username'; ";
    $result1 = mysqli_query($con, $sql1);
    if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
            $joinCode = $row['joinCode'];
            $orgID = $row['orgID'];
        }

        if ($code == $joinCode) {
            $sql2 = "UPDATE org_members SET confirmJoined='1' WHERE username='$username'; ";
            $result2 = mysqli_query($con, $sql2);

            $sql3 = "UPDATE org_members SET joinCode='0' WHERE username='$username'; ";
            $result3 = mysqli_query($con, $sql3);

            if($result2 && $result3) {
                header('Location: ../home.php');
            }
        } else {
            echo "An Error Occured Try Again Later";
        }
    } else {
        echo "An Error Occured Try Again Later";
    }
}

?>

