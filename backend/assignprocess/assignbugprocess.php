<?php
require('../config.php');

if (isset($_POST["assign-btn"])) {
    session_start();

    $bugName = $_POST['bugName'];
    $bugID = $_POST['bugID'];


    $users = $_POST['members'];
   

    foreach ($users as $user) {
        $selectUser = "SELECT * FROM users WHERE username='$user'";
        $selectUserRes = $conn->query($selectUser);
        

        if(mysqli_num_rows($selectUserRes) > 0) {
            while ($row = mysqli_fetch_array($selectUserRes)) {
                $userID = $row['id'];
            }
        }
        $stmt = $conn->prepare("INSERT INTO bug_members (bugName, bugID, username, userID) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $bugName, $bugID, $user, $userID);

        $stmt->execute();
        $res = mysqli_stmt_get_result($stmt);

        if(!$res) {
            header("Location: ../../components/displays/bugdisplay.php?bugID=$bugID");
        } else {
            echo "An error has occured adding bug to project try again later.";
        }
        
        $stmt->close();
    }
   
}
?>