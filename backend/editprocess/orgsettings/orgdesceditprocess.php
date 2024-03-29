<?php
require('../../config.php');

if (isset($_POST["update-orgdesc-btn"])) {
    session_start();

    $orgid = $_POST['orgid'];
    $newOrgDesc = $_POST['orgdesc'];

    $stmt = $conn->prepare("UPDATE orgs SET orgDesc=? WHERE id=?");
    $stmt->bind_param("si", $newOrgDesc, $orgid);

    $stmt->execute();

    $res = mysqli_stmt_get_result($stmt);

    if(!$res) {
        header("Location: ../../../components/displays/orgdisplay.php?id=$orgid");
    } else {
        echo "An error has occured updating org settings try again later.";
    }

    $stmt->close();
}
?>