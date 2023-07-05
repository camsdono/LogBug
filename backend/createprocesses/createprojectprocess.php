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
            $key = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));

            $stmt = $conn->prepare("INSERT INTO projects (projectName, projectDesc, orgID, orgName, apiKey) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $projectName, $projectDesc, $orgid, $orgName, $key);
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