<?php

require('../config.php');

if (isset($_POST["create-project-btn"])) {
    session_start();

    $orgid = $_POST['orgID'];

    $getOrgInfo = "SELECT * FROM orgs WHERE id='$orgid'";
    $result = $conn->query($getOrgInfo);

    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $projectName = $_POST['projectName'];
            $projectDesc = $_POST['projectDesc'];
            $orgName = $row['orgName'];

            $stmt = $conn->prepare("INSERT INTO projects (projectName, projectDesc, orgID, orgName) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $projectName, $projectDesc, $orgid, $orgName);
            $stmt->execute();
            
            $res = mysqli_stmt_get_result($stmt);

            if(!$res && !$res1) {
                header("Location: ../../components/displays/orgdisplay.php?id=$orgid");
            } else {
                echo "An error has occured creating your project try again later.";
            }

            $stmt->close();
        }
        
    }
}

?>